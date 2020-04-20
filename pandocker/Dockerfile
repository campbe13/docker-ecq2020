# PMC 2020-04-17
# run pandoc via a container
# file & config file for script on a shared volume
# see runtime

FROM pandoc/core 

LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-04-17"

RUN addgroup pandoc && adduser pandoc -D -G pandoc
USER pandoc
COPY pandoc.sh /usr/bin/
# launch
ENTRYPOINT [ "/usr/bin/pandoc.sh" ]
# for shelling into the container
#CMD sh
