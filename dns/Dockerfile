FROM ubuntu:latest

RUN apt update && apt upgrade -y && apt install bind9 -y

COPY named.conf /etc/bind/
COPY named.conf.options /etc/bind/
COPY named.conf.zones /etc/bind/
COPY named.conf.local /etc/bind/
COPY db.local.wt1.ephec-ti.be /etc/bind/
COPY db.wt1.ephec-ti.be /etc/bind/

EXPOSE 53

CMD named -g