FROM nginx:mainline

RUN apt update && apt install cron
# RUN apt update && apt install -y certbot python3-certbot-dns-ovh
RUN apt update && apt install -y python3-pip
RUN pip3 install certbot certbot-dns-ovh --break-system-packages

EXPOSE 80 443

CMD cron && nginx -g "daemon off;"
