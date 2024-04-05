#!/bin/bash
mysql < /potatoServerConfig/initial.sql       # create forum database and add user
mysql forum < /potatoServerConfig/forum.sql   # set up forum database
rm -rf /potatoServerConfig                    # remove config directory
rm /etc/init.d/atbootconfig.sh                # remove this file
