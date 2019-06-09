FROM ubuntu:latest

RUN apt update -y && apt upgrade -y

RUN apt-get install build-essential -y
RUN apt-get install git-core subversion libjansson-dev sqlite autoconf automake libxml2-dev libncurses5-dev libtool -y
RUN apt-get install wget -y
RUN apt install aptitude aptitude-common libboost-filesystem1.65.1 libboost-iostreams1.65.1 libboost-system1.65.1 libcgi-fast-perl libcgi-pm-perl libclass-accessor-perl libcwidget3v5 libencode-locale-perl libfcgi-perl libhtml-parser-perl libhtml-tagset-perl libhttp-date-perl libhttp-message-perl libio-html-perl libio-string-perl liblwp-mediatypes-perl libparse-debianchangelog-perl libsigc++-2.0-0v5 libsub-name-perl libtimedate-perl liburi-perl libxapian30 -y

WORKDIR /opt/
RUN wget http://downloads.asterisk.org/pub/telephony/asterisk/asterisk-15.7.2.tar.gz
RUN tar -zxvf asterisk-15.7.2.tar.gz

WORKDIR /opt/asterisk-15.7.2
RUN DEBIAN_FRONTEND=noninteractive sh contrib/scripts/install_prereq install -y

RUN DEBIAN_FRONTEND=noninteractive sh configure 

RUN make
RUN make install
RUN make samples
RUN make config
RUN make install-logrotate

COPY extensions.conf /etc/asterisk/extensions.conf
COPY iax.conf /etc/asterisk/iax.conf
COPY sip.conf /etc/asterisk/sip.conf
COPY users.conf /etc/asterisk/users.conf
COPY voicemail.conf /etc/asterisk/voicemail.conf

RUN sed -i "s/rtpstart=10000/rtpstart=10000/g" /etc/asterisk/rtp.conf
RUN sed -i "s/rtpend=20000/rtpend=11000/g" /etc/asterisk/rtp.conf

EXPOSE 5060 5060/udp
EXPOSE 10000-11000/udp

CMD ["asterisk", "-f"]
