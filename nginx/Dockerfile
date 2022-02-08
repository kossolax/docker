FROM nginx:mainline

RUN apt update && apt install -y certbot python3-certbot-dns-ovh cron

EXPOSE 80 443

CMD cron && nginx -g "daemon off;"
