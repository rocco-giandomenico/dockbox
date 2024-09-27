#!/bin/bash

DEF_KEYSIZE=2048
DEF_DAYS=3650
DEF_SIGN_SIGNATURE="sha256"
CA_KEY_FILE="/etc/apache2/ssl/root-ca.key"
CA_CRT_FILE="/etc/apache2/ssl/root-ca.crt"
SUBJECT="/C=IT/ST=Rome/L=Rome/O=dockbox/OU=dockbox/CN=dockbox.org/emailAddress=ca@dockbox.org"

CA_CONFIG="$( cat <<'HEREDOC'
[req]
distinguished_name = req_distinguished_name

[req_distinguished_name]

[ v3_ca ]
basicConstraints = critical, CA:TRUE
subjectKeyIdentifier = hash
keyUsage = critical, digitalSignature, cRLSign, keyCertSign
authorityKeyIdentifier = keyid:always,issuer:always
HEREDOC
)"

openssl genrsa \
  -out ${CA_KEY_FILE} \
  ${DEF_KEYSIZE}

openssl req \
  -new \
  -x509 \
  -nodes \
  -${DEF_SIGN_SIGNATURE} \
  -days ${DEF_DAYS} \
  -key ${CA_KEY_FILE} \
  -subj ${SUBJECT} \
  -extensions v3_ca \
  -config <(echo \"${CA_CONFIG}\") \
  -out ${CA_CRT_FILE}