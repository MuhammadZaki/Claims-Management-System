#!/usr/bin/env bash

export COMPOSE_PROJECT_NAME=composer

source ./hlfv12/startFabric.sh

source ./hlfv12/createPeerAdminCard.sh

PRIVATE_KEY="${DIR}"/composer/crypto-config/peerOrganizations/org1.example.com/users/Admin@org1.example.com/msp/keystore/114aab0e76bf0c78308f89efc4b8c9423e31568da0c340ca187a9b17aa9a4457_sk
CERT="${DIR}"/composer/crypto-config/peerOrganizations/org1.example.com/users/Admin@org1.example.com/msp/signcerts/Admin@org1.example.com-cert.pem


composer archive create -t dir -n hia-contract -a hia.bna

composer network install -c PeerAdmin@hlfv1 -a hia.bna

composer network start -n hia -V v0.1.0 -A admin -C "${CERT}" -c PeerAdmin@hlfv1

composer card create -u admin -n hia -c "${CERT}" -k "${PRIVATE_KEY}" -p ./hlfv12/DevServer_connection.json -f admin@hia.card


if composer card list -c admin@hia > /dev/null; then
        composer  card delete -c admin@hia
fi

composer card import -f admin@hia.card

composer network ping -c admin@hia

composer card create -u admindocker -n hia -c "${CERT}" -k "${PRIVATE_KEY}" -p ./hlfv12/DevServer_connection_docker.json -f admindocker@hia.card

if composer card list -c admindocker@hia > /dev/null; then
        composer card delete -c admindocker@hia
fi

composer card import -f admindocker@hia.card
