FROM nginx:mainline

RUN apt update && apt install -y cron
# RUN apt update && apt install -y certbot python3-certbot-dns-ovh
RUN apt update && apt install -y python3-pip
RUN pip3 install certbot certbot-dns-ovh certbot-dns-cpanel --break-system-packages
RUN echo "0 0 * * * root /usr/local/bin/certbot renew &>> /var/log/cron.log" > /etc/cron.d/certbot-renew
RUN echo "*/15 * * * * root /usr/bin/python3 /var/www/zaretti.be/update_ip.py &>> /var/log/cron.log" > /etc/cron.d/ip-renew

EXPOSE 80 443

CMD cron && nginx -g "daemon off;"
