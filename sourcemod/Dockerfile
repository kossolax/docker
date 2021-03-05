FROM ubuntu:latest

RUN apt update && apt install -y g++-multilib lib32z1-dev clang lib32stdc++6
RUN apt update && apt install -y git curl wget python3-distutils python3-apt

WORKDIR /alliedmodders
RUN git clone --recursive https://github.com/alliedmodders/sourcemod
RUN bash sourcemod/tools/checkout-deps.sh

CMD ["bash"]
