FROM nginx:mainline

RUN apt update && apt install -y cron
# RUN apt update && apt install -y certbot python3-certbot-dns-ovh
RUN apt update && apt install -y python3-pip
RUN pip3 install certbot certbot-dns-ovh --break-system-packages
RUN echo "0 0 * * * root certbot renew &>> /var/log/cron.log" > /etc/cron.d/certbot-renew

EXPOSE 80 443

CMD cron && nginx -g "daemon off;"
