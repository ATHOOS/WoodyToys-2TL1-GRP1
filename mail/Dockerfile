FROM ubuntu:latest

RUN apt update -y && apt upgrade -y

RUN touch /var/log/tallylog
RUN chmod 600 /var/log/tallylog

RUN apt install nano -y && DEBIAN_FRONTEND=noninteractive apt install postfix -y
RUN mv /etc/postfix/main.cf /etc/postfix/main.cf.bak

RUN DEBIAN_FRONTEND=noninteractive apt install dovecot-core dovecot-imapd dovecot-pop3d dovecot-lmtpd -y
RUN apt install spamassassin spamc -y
RUN apt install dovecot-sieve dovecot-managesieved -y
RUN mkdir /var/mail/vhosts
RUN mkdir /var/mail/vhosts/wt1.ephec-ti.be
RUN groupadd -g 5000 vmail
RUN useradd -r -g vmail -u 5000 vmail -d /var/mail/vhosts -c "virtual mail user"
RUN chown -R vmail:vmail /var/mail/vhosts/
RUN groupadd spamd
RUN useradd -g spamd -s /bin/false -d /var/log/spamassassin spamd
RUN mkdir /var/log/spamassassin
RUN chown spamd:spamd /var/log/spamassassin
RUN service spamassassin start
RUN mkdir /var/lib/dovecot/sieve/

COPY hosts /etc/hosts
COPY mailname /etc/mailname
COPY main.cf /etc/postfix/main.cf
COPY virtual_mailbox_domains /etc/postfix/virtual_mailbox_domains
COPY virtual_alias /etc/postfix/virtual_alias
COPY master.cf /etc/postfix/master.cf
COPY 10-mail.conf /etc/dovecot/conf.d/10-mail.conf
COPY 10-master.conf /etc/dovecot/conf.d/10-master.conf
COPY 10-auth.conf /etc/dovecot/conf.d/10-auth.conf
COPY 10-ssl.conf /etc/dovecot/conf.d/10-ssl.conf
COPY auth-passwdfile.conf.ext /etc/dovecot/conf.d/auth-passwdfile.conf.ext
COPY dovecot-users /etc/dovecot/dovecot-users
COPY wt1.ephec-ti.be.crt /opt/wt1.ephec-ti.be.crt
COPY wt1.ephec-ti.be.key /opt/wt1.ephec-ti.be.key
COPY start_services.sh /opt/start_services.sh
COPY spamassassin /etc/default/spamassassin
COPY local.cf /etc/spamassassin/local.cf
COPY 20-lmtp.conf /etc/dovecot/conf.d/20-lmtp.conf
COPY default.sieve /var/lib/dovecot/sieve/default.sieve

RUN sievec /var/lib/dovecot/sieve/default.sieve
RUN chown -R vmail:vmail /var/lib/dovecot/sieve/*
RUN chmod a+x /var/lib/dovecot

RUN postmap /etc/postfix/virtual_mailbox_domains
RUN postmap /etc/postfix/virtual_alias

RUN chmod +x /opt/start_services.sh



EXPOSE 25 110 143 465 587 993 995

CMD /opt/start_services.sh


