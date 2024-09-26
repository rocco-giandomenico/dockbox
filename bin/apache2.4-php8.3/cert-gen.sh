#!/bin/bash

FOLDER="/etc/apache2/ssl/"

openssl genrsa -out ${FOLDER}root-ca.key 2048
openssl req -x509 -new -nodes -key ${FOLDER}root-ca.key -sha256 -days 3650 -out ${FOLDER}root-ca.pem \
  -subj "/C=IT/ST=Rome/L=Rome/O=dockbox/OU=dockbox/CN=dockbox.org/emailAddress=ca@dockbox.org"

openssl genrsa -out ${FOLDER}dockbox.key 2048

DOMAIN="dok"

openssl req -new -key ${FOLDER}dockbox.key -out ${FOLDER}dockbox.csr \
  -subj "/C=IT/ST=Rome/L=Rome/O=dockbox/OU=dockbox/CN=localhost/emailAddress=ca@dockbox.org" \
  -reqexts SAN \
  -config <(printf "[req]\ndistinguished_name=req_distinguished_name\n[req_distinguished_name]\nC=IT\nST=Rome\nL=Rome\nO=dockbox\nOU=dockbox\nCN=localhost\nemailAddress=ca@dockbox.org\n[SAN]\nsubjectAltName=DNS:localhost,DNS:*.${DOMAIN}\n")

openssl x509 -req -in ${FOLDER}dockbox.csr -CA ${FOLDER}root-ca.pem -CAkey ${FOLDER}root-ca.key -CAcreateserial -out ${FOLDER}dockbox.crt -days 365 -sha256