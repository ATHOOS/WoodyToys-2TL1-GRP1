FROM ubuntu:latest

RUN apt update && apt upgrade -y && DEBIAN_FRONTEND=noninteractive apt install -y apache2 php php-mysql nano

RUN a2enmod ssl

COPY wt1.ephec-ti.be.conf /etc/apache2/sites-available
COPY intranet.wt1.ephec-ti.be.conf /etc/apache2/sites-available
COPY b2b.wt1.ephec-ti.be.conf /etc/apache2/sites-available

RUN ln -s /etc/apache2/sites-available/wt1.ephec-ti.be.conf /etc/apache2/sites-enabled
RUN ln -s /etc/apache2/sites-available/intranet.wt1.ephec-ti.be.conf /etc/apache2/sites-enabled
RUN ln -s /etc/apache2/sites-available/b2b.wt1.ephec-ti.be.conf /etc/apache2/sites-enabled

RUN mkdir /etc/letsencrypt
COPY wt1.ephec-ti.be.key /etc/letsencrypt/
COPY wt1.ephec-ti.be.crt /etc/letsencrypt/
COPY b2b.wt1.ephec-ti.be.key /etc/letsencrypt/
COPY b2b.wt1.ephec-ti.be.crt /etc/letsencrypt/
COPY intranet.wt1.ephec-ti.be.key /etc/letsencrypt/
COPY intranet.wt1.ephec-ti.be.crt /etc/letsencrypt/

RUN mkdir /var/www/wt1.ephec-ti.be
RUN mkdir /var/www/b2b.wt1.ephec-ti.be
RUN mkdir /var/www/intranet.wt1.ephec-ti.be

COPY wt1.ephec-ti.be.html /var/www/wt1.ephec-ti.be/index.html
COPY b2b.wt1.ephec-ti.be.php /var/www/b2b.wt1.ephec-ti.be/index.php
COPY Connexion.php /var/www/b2b.wt1.ephec-ti.be/Connexion.php
COPY intranet.wt1.ephec-ti.be.html /var/www/intranet.wt1.ephec-ti.be/index.html

EXPOSE 80 443

CMD apachectl -DFOREGROUND
