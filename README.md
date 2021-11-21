# projet_Web_cocktails
usefull `git` commands: 
- git fetch + git merge (updates your local repo from remote repo)
- git add + git commit (updates local repo with new changes)
- git push (adds changes to remote repo)
see all commands in "git_commands.png".
- git pull to update

To start coding:

navigate to your Web server directory and enter the following commands:
  - `git clone https://github.com/mvaitlhliaslta/projet_Web_cocktails`
  
  or (try the first one then, if fail, the second):
    - `git clone https://github.com/mvaitlhliaslta/projet_Web_cocktails.git`
  
  - `git pull`
 
if `git pull` doesn't work:
- generate token
- `git config --global credential.helper cache`
- `git pull`

if `git pull` doesnt work:
- `git pull https://<token>@github.com/mvaitlhliaslta/projet_Web_cocktails`

Finally:
- `git branch --set-upstream-to=origin/master`
    
