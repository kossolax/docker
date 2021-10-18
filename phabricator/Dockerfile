FROM bitnami/phabricator:latest

USER root

RUN apt update && apt install -y subversion wget zip npm
RUN npm install -g render2katex

# Fix: https://github.com/bitnami/bitnami-docker-phabricator/issues/151
RUN ln -s /opt/bitnami/php/bin/php /usr/bin/php

# PATCH
WORKDIR /opt/bitnami/phabricator/webroot/rsrc/externals

# ALGO STYLE:
RUN wget https://github.com/tonsky/FiraCode/releases/download/5.2/Fira_Code_v5.2.zip && \
    unzip Fira_Code_v5.2.zip && \
    echo -e "/**\n * @provides fire_code\n */\n$(cat fira_code.css)" > fira_code.css

# CUSTOM CSS:
COPY ./patch/webroot/rsrc/css/core/core.css /tmp/patch.txt
RUN cat /tmp/patch.txt >> /opt/bitnami/phabricator/webroot/rsrc/css/core/core.css

# CUSTOM JS:
COPY ./patch/webroot/rsrc/externals/javelin/core/init.js /tmp/patch.txt
RUN cat /tmp/patch.txt >> /opt/bitnami/phabricator/webroot/rsrc/externals/javelin/core/init.js

# EXTENSIONS:
COPY ./patch/src/extensions/* /opt/bitnami/phabricator/src/extensions/
COPY ./patch/support/* /opt/bitnami/phabricator/support/

# EXTERNALS

COPY ./patch/pygment/pseudo.py /usr/lib/python3/dist-packages/pygments/lexers/
RUN sed -i "s/.*PanLexer.*/'PseudoLexer': \('pygments.lexers.pseudo', 'Pseudo', \('pseudo','pseudocode'\), \('*.pc',\), \(\)\),/" /usr/lib/python3/dist-packages/pygments/lexers/_mapping.py


# APPLY ALL PATCH AT BOOT
ARG ENTRY=/opt/bitnami/scripts/phabricator/entrypoint.sh
RUN echo "$(head -n -2 $ENTRY)" > $ENTRY && \
    echo 'php /opt/bitnami/phabricator/bin/celerity map' >> $ENTRY && \
    echo 'php /opt/bitnami/phabricator/bin/cache purge --all' >> $ENTRY && \
    echo 'exec "$@"' >> $ENTRY && \
    chmod +x $ENTRY && \
    cat $ENTRY

RUN chmod 777 /opt/bitnami/phabricator/resources/celerity/map.php

USER 1001
