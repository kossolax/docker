FROM linuxserver/webtop:ubuntu-kde

WORKDIR /tmp
RUN apt update && apt install wget
RUN wget -q https://steve.zaretti.be/files/PacketTracer_800_amd64_build212_final.deb -O PacketTracer8.deb && \
    echo "yes" | dpkg -i PacketTracer8.deb ; rm PacketTracer8.deb
