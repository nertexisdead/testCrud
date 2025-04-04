## Table of Contents
- [Description](#description)
- [Local deployment](#local-deployment)

## Description
Crud under beer =)

## Local deployment
- Install [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- Clone project repo
- Run one of required commands below

Start, build run stack as daemon
```bash
docker compose -f docker-compose.local.yml up -d
```

Build images before start
```bash
docker compose -f docker-compose.local.yml up -d --build
```

Stop stack
```bash
docker compose -f docker-compose.local.yml down
```