#!/bin/sh

service postfix start
service spamassassin start
dovecot -F
