
# Discoteca

## GIT - COMANDOS ÚTEIS

### Configurar nome e email
*git config --global user.name "Fulano de Tal"
git config --global user.email fulanodetal@exemplo.br*

### Clonar repositório
Criar pasta para projeto e entrar nela
*git clone https://github.com/edugradischnig/hackaton_ifrs_feliz_2024.git .*

### Criar uma nova branch (alterando para ela)
*git checkout -b "nome_da_branch"*

### Alterar para alguma branch
*git switch nome_da_branch*

### Deletar uma branch local
*git branch -d nome_da_branch*

### Adicionar arquivos para área de stage
*git add nome_do_arquivo*
### Comitar
*git commit -m "mensagem do commit"*
### Enviar alterações da branch atual para servidor remoto (Github)
*git push*
### Baixar alterações da branch atual do servidor remoto (Github)
*git pull*
### Unir alterações de outra branch na branch atual
-> precisa estar dentro da branch atual
*git merge nome_outra_branch*
### Ver últimos commits da branch
git logs
### Remover ~~N~~ commits na branch local
*git reset HEAD~~~N~~*
