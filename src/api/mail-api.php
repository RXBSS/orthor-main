<?php

// Klassen hinzufügen
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



/**
 * In diser Klassen machen wir das und das 
 * Das funktioniert so und so
 * 
 * Bitte aufpassen das das und das 
 * ..
 * 
 * 
 * 
 */
class Mail {

    public $instance;
    public $log;

    function __construct() {

        // New Mailer
        $this->instance = new PHPMailer;
        
        // Setzt die Standard Einstellungen
        $this->getSettings();
    }


    /**
     * Send Function
     */
    public function send($to, $subject, $body, $opt = []) {        

        $this->setSender($opt);
        $this->setReply($opt);
        $this->setTo($to);
        $this->setCc($opt);
        $this->setBcc($opt);
        $this->setAttachments($opt);

        $this->setSubject($subject);
        $this->setBody($body, $opt);

        $this->doSend();

        $this->writeLog();
    }



    /**
     *  Setzen wir die Default Settings aus der Konfigurationsdatei 
     */
    public function getSettings() {
        
        // 
        $this->instance->isSMTP();

        // Host und Port
		$this->instance->Host = $_SESSION['___settings']['mail']['server'];
		$this->instance->Port = intval($_SESSION['___settings']['mail']['port']);
		
		// Settings für die Authentifizierung
		$this->instance->SMTPAuth = $_SESSION['___settings']['mail']['auth'];
		
		// Prüfen ob eine Authentifizierung nötig ist
		if($_SESSION['___settings']['mail']['auth']) {
			
			// Authentifizierung
			$this->instance->Username = $_SESSION['___settings']['mail']['user'];
			$this->instance->Password = $_SESSION['___settings']['mail']['password'];

		}
		
		// SSL 
		if($_SESSION['___settings']['mail']['secure']) {
			$this->instance->SMTPSecure = $_SESSION['___settings']['mail']['secure'];
		}
		
		// Chartset
		$this->instance->CharSet = ($_SESSION['___settings']['mail']['charset']) ? $_SESSION['___settings']['mail']['charset'] : 'utf-8';

		// HTML Mail
		$this->instance->IsHTML(true); 
    }

    // 
    public function setSender($opt) {

        // Sender der Mail
        $senderMail = ($opt['sender']) ? $opt['sender'] : $_SESSION['___settings']['mail']['sender'];
		$senderName = ($opt['senderName']) ? $opt['senderName'] : (($_SESSION['___settings']['mail']['senderName']) ? $_SESSION['___settings']['mail']['senderName'] : false);
		
        // Prüfen 
		if($senderName) {
			$this->instance->setFrom($senderMail, $senderName);
			$log['sender'] = $senderMail.", ".$senderName;
		} else {
			$this->instance->setFrom($senderMail);
			$log['sender'] = $senderMail;
		}
    }

    public function setReply($opt) {

        // Sender der Mail
        $senderMail = ($opt['reply']) ? $opt['reply'] : $_SESSION['___settings']['mail']['reply'];
		$senderName = ($opt['replyName']) ? $opt['replyName'] : (($_SESSION['___settings']['mail']['replyName']) ? $_SESSION['___settings']['mail']['replyName'] : false);
		
        // Prüfen 
		if($senderName) {
			$this->instance->addReplyTo($senderMail, $senderName);
			$log['reply'] = $senderMail.", ".$senderName;
		} else {
			$this->instance->addReplyTo($senderMail);
			$log['reply'] = $senderMail;
		}
    }

    public function setTo($to) {
        
        // Standardisieren
        $to = (is_array($to)) ? $to : [$to];

        // Für jeden Empfänger
        foreach($to AS $value) {
            $this->instance->addAddress($value);
            $this->log['to'][] = $value;
        }
    }

    public function setCc($opt) {
        
        // Gibt es ein Cc?
        if($opt['cc']) {
            
            // Standardisieren
            $cc = (is_array($opt['cc'])) ? $opt['cc'] : [$opt['cc']];
    
            foreach($cc AS $value) {
                $this->instance->AddCC($value);
                $this->log['cc'][] = $value;
            }
        }
    }

    public function setBcc($opt) {
    
        // Gibt es ein Bcc?
        if($opt['bcc']) {
            
            // Standardisieren
            $bcc = (is_array($opt['bcc'])) ? $opt['bcc'] : [$opt['bcc']];
    
            foreach($bcc AS $value) {
                $this->instance->addBCC($value);
                $this->log['bcc'][] = $value;
            }
        }
    }

    // Anhänge setzen
    public function setAttachments($opt) {
        
        // Anahng prüfen
		if($opt['attachments']) {
            
            // Standardisieren
            $attachments = (is_array($opt['attachments'])) ? $opt['attachments'] : [$opt['attachments']];
    
            foreach($attachments AS $value) {
                $this->instance->AddAttachment($value , basename($value));
                $this->log['anhaenge'][] = $value;
            }			
		}
    }

    // Betreff setzen
    public function setSubject($subject) {
        $this->instance->Subject = $subject;
        $this->log['subject'] = $subject;
    }


    //     
    public function setBody($body, $opt) {

        // Nachricht initalisieren
        $message = "";

        // Header anfügen
	    $message .= (isset($opt['header'])) ? $opt['header'] : $this->getHeader();

        // egientliche Nachricht!
        $message .= $body;

        // Footer
        $message .= (isset($opt['footer'])) ? $opt['footer'] : $this->getFooter();

        // Wenn die Mail Debug steht
        if($_SESSION['___settings']['mail']['debug']) {

            // An die Nachricht anhängen
            $message .= "<hr>JSON DEBUG:<br>".json_encode($this->log);

        }

        // Log speichern
        $this->log['message'] = $message;

        // Mail als HTML
        $this->instance->msgHTML($message);

        // Mail für nicht HTML fähige Clients
        $this->instance->AltBody = strip_tags($body);
    }

    // Standard Header
    public function getHeader() {

        $html = "<html>
                <head>
                    <style>
                        h3,h4,p,td,th,li {
                            font-family: 'Open Sans', Arial, Helvetica, sans-serif;
                        } 
                        td,th {
                            text-align:left;
                        }
                    </style>
                </head>
                <body>";       

        return $html;
    }


    // Standard Footer
    public function getFooter() {

        $html = "<p>
                    <strong>".$_SESSION['___settings']['address']['name']."</strong><br>
                    ".$_SESSION['___settings']['address']['street']."<br>
                    ".$_SESSION['___settings']['address']['zip']." ".$_SESSION['___settings']['address']['city']."
                </p>
                <p>
                    <em>Diese Mail wurde automatisch versendet!</em>
                </p>
            </body>
        </html>";


        return $html;
    }


    // Mail vesenden
    public function doSend() {

        $success = false;
        $error = false;

        if($this->instance->send()) {
            $success = true;
        } else {
            $error = $this->instance->ErrorInfo;
        }

        // Ergebnis des Senden
        $this->log['send'] = $success;
        $this->log['error'] = $error;
    
    
        // Rückgabe
        return [
            'success' => $success,
            'error' => $error
        ];
    }


    // Log schreiben
    public function writeLog() {

        
        global $db;           

        // Query
        $query = "
            INSERT INTO `_mail_historie` SET 
                zeitstempel = NOW(),
                empfaenger = ".(($this->log['to']) ? "'".$db->real_escape_string(implode(" ",   $this->log['to']))."'" : "NULL").",
                cc = ".(($this->log['cc']) ? "'".$db->real_escape_string(implode(" ",   $this->log['cc']))."'" : "NULL").",
                bcc = ".(($this->log['bcc']) ? "'".$db->real_escape_string(implode(" ",   $this->log['bcc']))."'" : "NULL").",
                betreff = ".(($this->log['subject']) ? "'".$db->real_escape_string($this->log['subject'])."'" : "NULL").",
                sender = ".(($this->log['sender']) ? "'".$db->real_escape_string($this->log['sender'])."'" : "NULL").",
                reply = ".(($this->log['reply']) ? "'".$db->real_escape_string($this->log['reply'])."'" : "NULL").",
                anhaenge = ".(($this->log['anhaenge']) ? "'".$db->real_escape_string(implode(" ",   $this->log['anhaenge']))."'" : "NULL").",
                ergebnis = '".(($this->log['send']) ? 1 : 0)."',
                debug = '".(($_SESSION['___settings']['mail']['debug']) ? 1 : 0)."';		
        ";

        // Query in die Datenbank schreiben
        $result = $db->query($query);

        return $result;
    }





}

?>