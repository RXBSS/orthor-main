### Wichtige GIT Befehle <br><br>


1. `git branch` -> zeigt alle branches und den aktuellen auf dem wir uns befinden 
2. `git branch "nameDerBranchDieManWählt"` -> erstellt die neue Branch (ohne "")
3. `git checkout "nameDerBranchDieManWählt"` -> wechselt in die neue Branch (ohne "")
3. Alternative `git checkout -b "nameDerBranchDieManWählt"` -> erstellt einen Branch und wechselt direkt rein
4. `git add "nameDerDatei.txt"` -> Vorbereitung für den Commit (Staged Changes)


###### Ohne VS Code <br>
5. `git commit -m "message"` -> Deine Änderung und die message unter der er speichert<br>
6. `git push` -> lädt die Dateien hoch<br>

###### Mit VS Code -- <br>
5. Source Control <br>
6. Message oben eintragen <br>
7. Hacken setzen (oben rechts)<br>
8. Drei Punkte und dann auf push gehen<br>

###### Fehlermeldungen <br>
hint: Updates were rejected because the remote contains work that you do<br>
hint: not have locally. This is usually caused by another repository pushing<br>

Lösung: `git pull` -> jemand hat vor uns gepusht und wir haben nicht die aktuelle Versiongit <br>

 ###### Am Ende der Arbeit <br>
 `git checkout branchA` -> in den Branch wechseln in den rein gemergt werden soll (IMMER dev )<br>
 `git merge branchB` -> in die ausgecheckte Branch die BranchB reingemergen (d.h. test wird in dev reingemergt)<br>
 `git branch -d branchB` -> löscht die Test Branch lokal (lokal)<br>
 `git push origin --delete branchB` -> löscht die Test Branch Remote (GitHub)<br>

###### Coole Feature <br>
 `git status` -> zeigt alle nicht commiteden Dateien<br>
 `git diff branch1..branch2` -> zeig die Unterschiede zwischen zwei Branches<br>
 `git merge --abort` -> merge zum Abbrechen falls es Konflikte gegeben hat<br>
 `git push -u origin <branch>` -> pusht den lokalen Branch zum Remote (GitHub)<br>
 `git log --graph --oneline` -> zeigt git Graph auf der Konsole aus <br>
 `git log --graph --oneline --decorate --all` -> zeigt git Graph detaillierter aus<br>

###### Name einer Branch ändern <br>
 `git checkout <old_name_branch>` -> in die Branch wechseln deren Namen man ändern möchte <br>
 `git branch -m <new_name_branch>` -> neuen Namen vergeben in den man umändern möchte <br>
 `git push origin -u <new_name_branch` -> neue Branch mit neuem Name in den Remote auf GitHub pushen <br>
 `git push origin --delete <old_name_branch>` -> alte Branch mit altem Namen auf dem Remote auf GitHub löschen <br>


 
