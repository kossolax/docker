FROM linuxserver/netbootxyz:latest

ENV USER="nobody"
ENV PASS="nobody"

RUN apk add --no-cache samba

RUN mkdir -p /usr/local/samba/var
RUN echo -e '[public]\n\tpath = /assets/windows\n\tvalid users = '"${USER}"'\n\twritable = yes\n\n' >> /etc/samba/smb.conf
RUN mkdir /etc/services.d/smbd && echo -e '#!/usr/bin/with-contenv bash\nexec smbd -F' > /etc/services.d/smbd/run
RUN adduser kossolax --disabled-password --no-create-home && echo -ne "$PASS\n$PASS\n" | smbpasswd -a -s $LOGIN

EXPOSE 445
