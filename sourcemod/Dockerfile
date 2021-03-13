FROM ubuntu:18.04

RUN apt update && apt install -y g++-multilib lib32z1-dev clang lib32stdc++6
RUN apt update && apt install -y python3 python3-pip python3-distutils python3-apt
RUN apt update && apt install -y git curl wget nano

WORKDIR /alliedmodders
RUN git clone --recursive https://github.com/alliedmodders/sourcemod
RUN bash sourcemod/tools/checkout-deps.sh
WORKDIR /alliedmodders
RUN git clone https://github.com/perilouswithadollarsign/cstrike15_src

ENTRYPOINT ["sleep", "inf"]