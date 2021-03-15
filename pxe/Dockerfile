FROM linuxserver/netbootxyz:latest

RUN apk add --no-cache samba

RUN mkdir -p /usr/local/samba/var
RUN echo -e '[public]\n\tpath = /assets/windows\n\tpublic = yes\n\twritable = yes\n\n' >> /etc/samba/smb.conf
RUN mkdir /etc/services.d/smbd && echo -e '#!/usr/bin/with-contenv bash\nexec smbd' > /etc/services.d/smbd/run

EXPOSE 445
