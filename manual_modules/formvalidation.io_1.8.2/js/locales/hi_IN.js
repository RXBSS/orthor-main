(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    (global = typeof globalThis !== 'undefined' ? globalThis : global || self, (global.FormValidation = global.FormValidation || {}, global.FormValidation.locales = global.FormValidation.locales || {}, global.FormValidation.locales.hi_IN = factory()));
}(this, (function () { 'use strict';

    /**
     * Hindi (India) language package
     * Translated by @gladiatorAsh
     */

    var hi_IN = {
        base64: {
            default: 'कृपया एक वैध 64 इनकोडिंग मूल्यांक प्रविष्ट करें',
        },
        between: {
            default: 'कृपया %s और %s के बीच एक मूल्यांक प्रविष्ट करें',
            notInclusive: 'कृपया सिर्फ़ %s और %s के बीच मूल्यांक प्रविष्ट करें',
        },
        bic: {
            default: 'कृपया एक वैध BIC संख्या प्रविष्ट करें',
        },
        callback: {
            default: 'कृपया एक वैध मूल्यांक प्रविष्ट करें',
        },
        choice: {
            between: 'कृपया %s और %s के बीच विकल्पों का चयन करें',
            default: 'कृपया एक वैध मूल्यांक प्रविष्ट करें',
            less: 'कृपया कम से कम %s विकल्पों का चयन करें',
            more: 'कृपया अधिकतम %s विकल्पों का चयन करें',
        },
        color: {
            default: 'कृपया एक वैध रंग प्रविष्ट करें',
        },
        creditCard: {
            default: 'कृपया एक वैध क्रेडिट कार्ड संख्या प्रविष्ट करें',
        },
        cusip: {
            default: 'कृपया एक वैध CUSIP संख्या प्रविष्ट करें',
        },
        date: {
            default: 'कृपया एक वैध दिनांक प्रविष्ट करें',
            max: 'कृपया %s के पहले एक वैध दिनांक प्रविष्ट करें',
            min: 'कृपया %s के बाद एक वैध दिनांक प्रविष्ट करें',
            range: 'कृपया %s से %s के बीच एक वैध दिनांक प्रविष्ट करें',
        },
        different: {
            default: 'कृपया एक अलग मूल्यांक प्रविष्ट करें',
        },
        digits: {
            default: 'कृपया केवल अंक प्रविष्ट करें',
        },
        ean: {
            default: 'कृपया एक वैध EAN संख्या प्रविष्ट करें',
        },
        ein: {
            default: 'कृपया एक वैध EIN संख्या प्रविष्ट करें',
        },
        emailAddress: {
            default: 'कृपया एक वैध ईमेल पता प्रविष्ट करें',
        },
        file: {
            default: 'कृपया एक वैध फ़ाइल का चयन करें',
        },
        greaterThan: {
            default: 'कृपया %s से अधिक या बराबर एक मूल्यांक प्रविष्ट करें',
            notInclusive: 'कृपया %s से अधिक एक मूल्यांक प्रविष्ट करें',
        },
        grid: {
            default: 'कृपया एक वैध GRID संख्या प्रविष्ट करें',
        },
        hex: {
            default: 'कृपया एक वैध हेक्साडेसिमल संख्या प्रविष्ट करें',
        },
        iban: {
            countries: {
                AD: 'अंडोरा',
                AE: 'संयुक्त अरब अमीरात',
                AL: 'अल्बानिया',
                AO: 'अंगोला',
                AT: 'ऑस्ट्रिया',
                AZ: 'अज़रबैजान',
                BA: 'बोस्निया और हर्जेगोविना',
                BE: 'बेल्जियम',
                BF: 'बुर्किना फासो',
                BG: 'बुल्गारिया',
                BH: 'बहरीन',
                BI: 'बुस्र्न्दी',
                BJ: 'बेनिन',
                BR: 'ब्राज़िल',
                CH: 'स्विट्जरलैंड',
                CI: 'आइवरी कोस्ट',
                CM: 'कैमरून',
                CR: 'कोस्टा रिका',
                CV: 'केप वर्डे',
                CY: 'साइप्रस',
                CZ: 'चेक रिपब्लिक',
                DE: 'जर्मनी',
                DK: 'डेनमार्क',
                DO: 'डोमिनिकन गणराज्य',
                DZ: 'एलजीरिया',
                EE: 'एस्तोनिया',
                ES: 'स्पेन',
                FI: 'फिनलैंड',
                FO: 'फरो आइलैंड्स',
                FR: 'फ्रांस',
                GB: 'यूनाइटेड किंगडम',
                GE: 'जॉर्जिया',
                GI: 'जिब्राल्टर',
                GL: 'ग्रीनलैंड',
                GR: 'ग्रीस',
                GT: 'ग्वाटेमाला',
                HR: 'क्रोएशिया',
                HU: 'हंगरी',
                IE: 'आयरलैंड',
                IL: 'इज़राइल',
                IR: 'ईरान',
                IS: 'आइसलैंड',
                IT: 'इटली',
                JO: 'जॉर्डन',
                KW: 'कुवैत',
                KZ: 'कजाखस्तान',
                LB: 'लेबनान',
                LI: 'लिकटेंस्टीन',
                LT: 'लिथुआनिया',
                LU: 'लक्समबर्ग',
                LV: 'लाटविया',
                MC: 'मोनाको',
                MD: 'माल्डोवा',
                ME: 'मॉन्टेंगरो',
                MG: 'मेडागास्कर',
                MK: 'मैसेडोनिया',
                ML: 'माली',
                MR: 'मॉरिटानिया',
                MT: 'माल्टा',
                MU: 'मॉरीशस',
                MZ: 'मोज़ाम्बिक',
                NL: 'नीदरलैंड',
                NO: 'नॉर्वे',
                PK: 'पाकिस्तान',
                PL: 'पोलैंड',
                PS: 'फिलिस्तीन',
                PT: 'पुर्तगाल',
                QA: 'क़तर',
                RO: 'रोमानिया',
                RS: 'सर्बिया',
                SA: 'सऊदी अरब',
                SE: 'स्वीडन',
                SI: 'स्लोवेनिया',
                SK: 'स्लोवाकिया',
                SM: 'सैन मैरिनो',
                SN: 'सेनेगल',
                TL: 'पूर्वी तिमोर',
                TN: 'ट्यूनीशिया',
                TR: 'तुर्की',
                VG: 'वर्जिन आइलैंड्स, ब्रिटिश',
                XK: 'कोसोवो गणराज्य',
            },
            country: 'कृपया %s में एक वैध IBAN संख्या प्रविष्ट करें',
            default: 'कृपया एक वैध IBAN संख्या प्रविष्ट करें',
        },
        id: {
            countries: {
                BA: 'बोस्निया और हर्जेगोविना',
                BG: 'बुल्गारिया',
                BR: 'ब्राज़िल',
                CH: 'स्विट्जरलैंड',
                CL: 'चिली',
                CN: 'चीन',
                CZ: 'चेक रिपब्लिक',
                DK: 'डेनमार्क',
                EE: 'एस्तोनिया',
                ES: 'स्पेन',
                FI: 'फिनलैंड',
                HR: 'क्रोएशिया',
                IE: 'आयरलैंड',
                IS: 'आइसलैंड',
                LT: 'लिथुआनिया',
                LV: 'लाटविया',
                ME: 'मोंटेनेग्रो',
                MK: 'मैसेडोनिया',
                NL: 'नीदरलैंड',
                PL: 'पोलैंड',
                RO: 'रोमानिया',
                RS: 'सर्बिया',
                SE: 'स्वीडन',
                SI: 'स्लोवेनिया',
                SK: 'स्लोवाकिया',
                SM: 'सैन मैरिनो',
                TH: 'थाईलैंड',
                TR: 'तुर्की',
                ZA: 'दक्षिण अफ्रीका',
            },
            country: 'कृपया %s में एक वैध पहचान संख्या प्रविष्ट करें',
            default: 'कृपया एक वैध पहचान संख्या प्रविष्ट करें',
        },
        identical: {
            default: 'कृपया वही मूल्यांक दोबारा प्रविष्ट करें',
        },
        imei: {
            default: 'कृपया एक वैध IMEI संख्या प्रविष्ट करें',
        },
        imo: {
            default: 'कृपया एक वैध IMO संख्या प्रविष्ट करें',
        },
        integer: {
            default: 'कृपया एक वैध संख्या प्रविष्ट करें',
        },
        ip: {
            default: 'कृपया एक वैध IP पता प्रविष्ट करें',
            ipv4: 'कृपया एक वैध IPv4 पता प्रविष्ट करें',
            ipv6: 'कृपया एक वैध IPv6 पता प्रविष्ट करें',
        },
        isbn: {
            default: 'कृपया एक वैध ISBN संख्या दर्ज करें',
        },
        isin: {
            default: 'कृपया एक वैध ISIN संख्या दर्ज करें',
        },
        ismn: {
            default: 'कृपया एक वैध ISMN संख्या दर्ज करें',
        },
        issn: {
            default: 'कृपया एक वैध ISSN संख्या दर्ज करें',
        },
        lessThan: {
            default: 'कृपया %s से कम या बराबर एक मूल्यांक प्रविष्ट करें',
            notInclusive: 'कृपया %s से कम एक मूल्यांक प्रविष्ट करें',
        },
        mac: {
            default: 'कृपया एक वैध MAC पता प्रविष्ट करें',
        },
        meid: {
            default: 'कृपया एक वैध MEID संख्या प्रविष्ट करें',
        },
        notEmpty: {
            default: 'कृपया एक मूल्यांक प्रविष्ट करें',
        },
        numeric: {
            default: 'कृपया एक वैध दशमलव संख्या प्रविष्ट करें',
        },
        phone: {
            countries: {
                AE: 'संयुक्त अरब अमीरात',
                BG: 'बुल्गारिया',
                BR: 'ब्राज़िल',
                CN: 'चीन',
                CZ: 'चेक रिपब्लिक',
                DE: 'जर्मनी',
                DK: 'डेनमार्क',
                ES: 'स्पेन',
                FR: 'फ्रांस',
                GB: 'यूनाइटेड किंगडम',
                IN: 'भारत',
                MA: 'मोरक्को',
                NL: 'नीदरलैंड',
                PK: 'पाकिस्तान',
                RO: 'रोमानिया',
                RU: 'रुस',
                SK: 'स्लोवाकिया',
                TH: 'थाईलैंड',
                US: 'अमेरीका',
                VE: 'वेनेजुएला',
            },
            country: 'कृपया %s में एक वैध फ़ोन नंबर प्रविष्ट करें',
            default: 'कृपया एक वैध फ़ोन नंबर प्रविष्ट करें',
        },
        promise: {
            default: 'कृपया एक वैध मूल्यांक प्रविष्ट करें',
        },
        regexp: {
            default: 'कृपया पैटर्न से मेल खाते एक मूल्यांक प्रविष्ट करें',
        },
        remote: {
            default: 'कृपया एक वैध मूल्यांक प्रविष्ट करें',
        },
        rtn: {
            default: 'कृपया एक वैध RTN संख्या प्रविष्ट करें',
        },
        sedol: {
            default: 'कृपया एक वैध SEDOL संख्या प्रविष्ट करें',
        },
        siren: {
            default: 'कृपया एक वैध SIREN संख्या प्रविष्ट करें',
        },
        siret: {
            default: 'कृपया एक वैध SIRET संख्या प्रविष्ट करें',
        },
        step: {
            default: '%s के एक गुणज मूल्यांक प्रविष्ट करें',
        },
        stringCase: {
            default: 'कृपया केवल छोटे पात्रों का प्रविष्ट करें',
            upper: 'कृपया केवल बड़े पात्रों का प्रविष्ट करें',
        },
        stringLength: {
            between: 'कृपया %s से %s के बीच लंबाई का एक मूल्यांक प्रविष्ट करें',
            default: 'कृपया वैध लंबाई का एक मूल्यांक प्रविष्ट करें',
            less: 'कृपया %s से कम पात्रों को प्रविष्ट करें',
            more: 'कृपया %s से अधिक पात्रों को प्रविष्ट करें',
        },
        uri: {
            default: 'कृपया एक वैध URI प्रविष्ट करें',
        },
        uuid: {
            default: 'कृपया एक वैध UUID संख्या प्रविष्ट करें',
            version: 'कृपया एक वैध UUID संस्करण %s संख्या प्रविष्ट करें',
        },
        vat: {
            countries: {
                AT: 'ऑस्ट्रिया',
                BE: 'बेल्जियम',
                BG: 'बुल्गारिया',
                BR: 'ब्राज़िल',
                CH: 'स्विट्जरलैंड',
                CY: 'साइप्रस',
                CZ: 'चेक रिपब्लिक',
                DE: 'जर्मनी',
                DK: 'डेनमार्क',
                EE: 'एस्तोनिया',
                EL: 'ग्रीस',
                ES: 'स्पेन',
                FI: 'फिनलैंड',
                FR: 'फ्रांस',
                GB: 'यूनाइटेड किंगडम',
                GR: 'ग्रीस',
                HR: 'क्रोएशिया',
                HU: 'हंगरी',
                IE: 'आयरलैंड',
                IS: 'आइसलैंड',
                IT: 'इटली',
                LT: 'लिथुआनिया',
                LU: 'लक्समबर्ग',
                LV: 'लाटविया',
                MT: 'माल्टा',
                NL: 'नीदरलैंड',
                NO: 'नॉर्वे',
                PL: 'पोलैंड',
                PT: 'पुर्तगाल',
                RO: 'रोमानिया',
                RS: 'सर्बिया',
                RU: 'रुस',
                SE: 'स्वीडन',
                SI: 'स्लोवेनिया',
                SK: 'स्लोवाकिया',
                VE: 'वेनेजुएला',
                ZA: 'दक्षिण अफ्रीका',
            },
            country: 'कृपया एक वैध VAT संख्या %s मे प्रविष्ट करें',
            default: 'कृपया एक वैध VAT संख्या प्रविष्ट करें',
        },
        vin: {
            default: 'कृपया एक वैध VIN संख्या प्रविष्ट करें',
        },
        zipCode: {
            countries: {
                AT: 'ऑस्ट्रिया',
                BG: 'बुल्गारिया',
                BR: 'ब्राज़िल',
                CA: 'कनाडा',
                CH: 'स्विट्जरलैंड',
                CZ: 'चेक रिपब्लिक',
                DE: 'जर्मनी',
                DK: 'डेनमार्क',
                ES: 'स्पेन',
                FR: 'फ्रांस',
                GB: 'यूनाइटेड किंगडम',
                IE: 'आयरलैंड',
                IN: 'भारत',
                IT: 'इटली',
                MA: 'मोरक्को',
                NL: 'नीदरलैंड',
                PL: 'पोलैंड',
                PT: 'पुर्तगाल',
                RO: 'रोमानिया',
                RU: 'रुस',
                SE: 'स्वीडन',
                SG: 'सिंगापुर',
                SK: 'स्लोवाकिया',
                US: 'अमेरीका',
            },
            country: 'कृपया एक वैध डाक कोड %s मे प्रविष्ट करें',
            default: 'कृपया एक वैध डाक कोड प्रविष्ट करें',
        },
    };

    return hi_IN;

})));
