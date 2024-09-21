#!/bin/bash

# ------------------------------------------------------------------------------
# Create dashboard virtualhost

cat << EOF > /etc/apache2/sites-enabled/default.conf
<VirtualHost *:80>
    DocumentRoot ${APACHE_DOCUMENT_ROOT}
    ServerName localhost
	<Directory ${APACHE_DOCUMENT_ROOT}>
		Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
	</Directory>
</VirtualHost>

EOF

# ------------------------------------------------------------------------------
# SSL_TYPE plain

if [ "$SSL_TYPE" = "plain" ]; then
    cat << EOF >> /etc/apache2/sites-enabled/default.conf
<VirtualHost *:80>
    UseCanonicalName Off
    ServerName localhost
    VirtualDocumentRoot ${APACHE_SHARED_ROOT}/%1
    ServerAlias *.${DOMAIN}
    <Directory ${APACHE_SHARED_ROOT}>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF

fi

# ------------------------------------------------------------------------------
# MESSAGE

echo "File di configurazione creato con successo."