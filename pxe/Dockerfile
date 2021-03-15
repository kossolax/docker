FROM linuxserver/netbootxyz:latest

RUN apk add --no-cache samba


RUN mkdir -p /usr/local/samba/var
RUN echo -e '[public]\n\tpath = /assets/windows\n\tbrowsable = yes\n\tguest ok = yes\n\tguest account = nobody\n\twritable = no\n\tcreate mask = 0775\n\tdirectory mask = 0755\n\n' >> /etc/samba/smb.conf
RUN sed -i "s/;   hosts allow = 192.168.1. 192.168.2. 127./hosts allow = 192.168.0.0\/16 127.0.0.0\/8 10.0.0.0\/8 172.16.0.0\/12/g" /etc/samba/smb.conf
RUN mkdir /etc/services.d/smbd && echo -e '#!/usr/bin/execlineb -P\nsmbd --foreground --no-process-group --debuglevel=10' > /etc/services.d/smbd/run
RUN echo -ne "nobody\nnobody\n" | smbpasswd -a -s nobody

EXPOSE 445
