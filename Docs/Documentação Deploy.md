# Documentação Sobre o Deploy

Este arquivo tem como objetivo relatar as dificuldades do grupo com relação ao deploy do projeto de mds e quais foram as soluções utilizadas para abordar o problema e qual foi a decisão tomada pelo grupo.

Devido a grande complexidade do Moodle e a sua natureza de  página dinâmica, visto que o moodle trabalha em diferentes níveis de arquitetura além de trabalhar extensivamente com bancos de dados, não foi possível utilizar os métodos tradicionais para realizar o deploy do projeto. 

Todavia, após reuniões com um monitor da disciplina com experiência na área de deploy, Bruno Felix, o grupo obteve o conhecimento de alguns sites que poderiam realizar o deploy do projeto:

* Netlify;
* Heroku;
* Digital Ocean;
* GCP Cloud;
* Docker;
* Infinity Free;
* Filezilla;
* Moodle Cloud

Entretanto, todos os sites e programas listados acima tiveram algum problema para a apresentação do projeto.

## Netlify

### Tecnologia: 
O Netlify é um serviço de hospedagem e implantação de sites e aplicativos da web. Ele fornece uma plataforma completa para construir, implantar e gerenciar seus projetos online de forma simples e eficiente.

Com o Netlify, podemos conectar nosso repositório Git  e configurar implantações automáticas sempre que você fizer alterações no código. Ele suporta várias linguagens de programação e frameworks populares, como HTML, CSS, JavaScript, React, Angular, Vue.js e muito mais. Uma das principais características do Netlify é sua abordagem que promove a construção de sites estáticos altamente performáticos e seguros. 

### Problema:
Dado o que foi apresentado acima, o site acima apresentou problemas no seguinte aspecto, apesar da plataforma ser gratuita, o netlify trabalha apenas com domínios estáticos, o que não se enquadra tanto para o Moodle quanto para  Moody.

## Heroku

### Tecnologia:

O Heroku é uma plataforma em nuvem que permite que você implante, execute e gerencie aplicativos da web. Ele oferece uma infraestrutura escalável para hospedar seus aplicativos sem a necessidade de gerenciar servidores ou configurar complexas configurações de hospedagem.

O Heroku suporta várias linguagens de programação populares, como Ruby, Python, Java, Node.js e PHP, e permite que você implante aplicativos desenvolvidos nessas linguagens. Ele também fornece integração com bancos de dados, como o PostgreSQL, bem como suporte a recursos como balanceamento de carga, escalonamento automático e monitoramento de desempenho.

### Problemas:

A plataforma acima além de necessitar de um cartão de crédito para realizar qualquer operação no site, também seria necessário uma extensa alteração nos arquivos do projeto para tornar o Moody viável para o deploy dentro da plataforma, o que seria inviável por conta da quantidade de alterações e o tempo restante para a entrega do projeto.


## Digital Ocean

### Tecnologia:

A DigitalOcean é uma empresa de infraestrutura em nuvem que fornece serviços de hospedagem na nuvem para desenvolvedores, startups e empresas. Eles oferecem uma variedade de soluções em nuvem, incluindo servidores virtuais (também conhecidos como Droplets), armazenamento em blocos, bancos de dados gerenciados, serviços de rede e ferramentas de gerenciamento

### Problemas:

As problemáticas encontradas com a plataforma foram similares às encontradas com o Heroku. Não obstante, mesmo a página sendo formada ela apresentava diversos erros o que necessitaria diversas modificações no projeto que não teriam nenhuma garantia de funcionamento, o que tornou o Digital Ocean inviável para o grupo, mesmo sendo gratuito.

## GCP Cloud

### Tecnologia:
O Google Cloud Platform (GCP) é uma plataforma de computação em nuvem oferecida pelo Google. Ele fornece uma variedade de serviços para ajudar indivíduos e organizações a criar, implantar e dimensionar aplicativos, sites e serviços na infraestrutura global do Google.

O GCP oferece uma ampla gama de serviços, incluindo armazenamento de dados, computação em nuvem, análise de dados, aprendizado de máquina, inteligência artificial, Internet das Coisas (IoT), redes, segurança e muito mais. Alguns dos serviços populares do GCP incluem:


Além desses serviços, o GCP também oferece serviços de banco de dados, rede, segurança, análise de dados em tempo real, Internet das Coisas, desenvolvimento de aplicativos móveis e muito mais.

### Problemas: 

Além de exigir um cartão de crédito para todas as operações no site, a plataforma também requer uma extensa modificação nos arquivos do projeto para tornar o Moody adequado para implantação nela. No entanto, essa tarefa é inviável devido ao grande número de alterações necessárias e ao prazo restante para a conclusão do projeto.

## Docker

### Tecnologia:

Docker é uma plataforma de código aberto que permite empacotar, distribuir e executar aplicativos em contêineres. Um contêiner é uma unidade isolada e leve que contém tudo o que é necessário para que um aplicativo seja executado, incluindo o código, bibliotecas, dependências e configurações do sistema.
O Docker simplifica o processo de desenvolvimento, implantação e dimensionamento de aplicativos, promovendo a portabilidade, a escalabilidade e a eficiência.

### Problemas:

Ao  realizar a construção da imagem e da build do projeto, todavia ao acessar o link da porta o usuário era bloqueado com uma mensagem de “Forbidden Acess” .Ademais, as tentativas de resolver tal problema ao alterar os arquivos do Moody a imagem parava de funcionar o que tornaria necessário refazer todo o projeto do docker.

## Infinity Free / Filezilla

### Tecnologia:

O infinity é um site que disponibiliza subdomínios de forma gratuita por certo período de tempo.

O FileZilla é um software de código aberto amplamente utilizado para transferência de arquivos entre um computador local e um servidor remoto. Ele fornece uma maneira fácil e eficiente de enviar e receber arquivos por meio de protocolos como FTP (File Transfer Protocol), FTPS (FTP seguro) e SFTP (SSH File Transfer Protocol).

Além da transferência de arquivos, o FileZilla também oferece recursos adicionais, como a capacidade de gerenciar sites e conexões, editar arquivos remotamente e definir permissões de arquivos e pastas no servidor.

### Problemas:

Pelo fato do arquivo do Moodle ser muito grande, o tempo necessário para enviar todos os arquivos para a plataforma é de 3~5 horas. Desse modo, o grupo pensou em enviar os arquivos do Moodle de forma descompactada ou em formato  .Zip. Todavia o arquivo continuava muito grande para ser enviado dessa forma. Dessa forma, o grupo decidiu usar o programa Filezilla os diversos erros de conexão, arquivos sumindo da plataforma, a impossibilidade de enviar arquivos fragmentados ou em formato .Zip também o tornou inviável para o uso.

## Moodle Cloud

### Tecnologia:

O Moodle Cloud foi projetado para fornecer uma solução rápida e fácil para aqueles que desejam experimentar e usar o Moodle sem a necessidade de configurar um servidor ou hospedagem própria. Ele permite que os educadores e instrutores criem e gerenciem seus cursos online em um ambiente hospedado na nuvem, sem precisar lidar com a parte técnica da infraestrutura.

### Problemas:

O moodle cloud é um serviço do moodle gera na nuvem uma versão do próprio moodle de forma automática que, de tal forma que acaba com a necessidade de haver um domínio e configurá-lo do zero. É um serviço pago, no entanto, disponibiliza um trials
O programa acima não permite a alteração dos arquivos raiz do Moodle, o que tornaria impossível o deploy do Moody.
