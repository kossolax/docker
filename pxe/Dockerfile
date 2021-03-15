FROM linuxserver/netbootxyz:latest

RUN apk add --no-cache samba

RUN echo -e '[public]\n\tpath = /assets/windows\n\tpublic = yes\n\twritable = yes\n\n' >> /etc/samba/smb.conf
RUN mkdir /etc/services.d/samba && echo -e '#!/usr/bin/with-contenv bash\nexec s6-setuidgid abc smbd' > /etc/services.d/samba/run

EXPOSE 445
