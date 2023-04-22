# Tutorial de como usar o git

## Clonar o repositorio
Em uma pasta vazia abra o git e execute 
> git clone https://github.com/fga-eps-mds/2023.1-Moody.git
## Atualizar a maquina local para uma nova versão
> git pull
## Atualizar o repositorio na nuvem 
Feita as alterações digite
> git add `nome da pasta`
> 
Ou caso queira adicionar todas as pastas
>git add .

Para verificar se a adição foi efetuada digite
>git status

Assim basta efetuar o commit com:
>git commit -m "`sua mensagem`"

# Voltar para versões anteriores localmente

>git log
>
Mostra todas as versões anteriores do repositorio

Basta digitar :
>git checkout `código da versão`

Caso queira que isso se trone parte do repositorio na nuvem basta executar o processo padão de commit

## Navegar e criar uma branch

>git checkout 

Mostra as branchs existentes

Para navegar em uma branch execute:

>git checkout `nome da branch existente`

Caso queira criar uma branch :
>git checkout `branch não existente`

Para juntar as alterações feitas na branch para a main use:
>git checkout `main`
>
>git merge `branch`





