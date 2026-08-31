# EchoWave

EchoWave is a distributed music platform inspired by services such as **Bandcamp** and **Soundcloub**.

The project focuses primarily on **backend development, microservice architecture, distributed systems, and DevOps**, while keeping the frontend at a moderate level of complexity.

## Project Overview

EchoWave allows users to:

- Create an account
- Create artist and band profiles
- Upload and publish music
- Create albums and releases
- Listen to music
- Like and comment on music

The platform is divided into several independent microservices, each responsible for a specific domain.

## Architecture

EchoWave uses a **microservice architecture**.

### High-level architecture

```mermaid

graph TD

Client[Web Client]
Client -->|REST / HTTP| API[API Gateway]

Discovery[Discovery Service]

API -->Discovery[Discovery Service]

Discovery --> API2[API Gateway]
Discovery --> DiscoveryDB[(Discovery DB)]

API2 <--> Users[Users Service]
API2 <--> Band[Band Service]
API2 <--> Music[Music Service Python]
API2 <--> Stream[Stream Service]
API2 <--> Social[Social Service]
API2 <--> Auth 

Stream --> R2[Cloudflare R2]
Music --> MusicR2[Music Cloudflare R2]

Auth --> AuthDB[(Auth DB)]
Users --> UsersDB[(Users DB)]
Band --> BandDB[(Band DB)]
Music --> MusicDB[(Music DB)]
Stream --> StreamDB[(Stream DB)]
Social --> SocialDB[(Social DB)]


```

```mermaid
graph TD

Auth[Auth Service]
Users[Users Service]
Band[Band Service]
Music[Music Service Python]
Stream[Stream Service]
Social[Social Service]

Auth <-.-> RabbitMQ
Users <-.-> RabbitMQ
Band <-.-> RabbitMQ
Music <-.-> RabbitMQ
Stream <-.-> RabbitMQ
Social <-.-> RabbitMQ

```

## CI/CD Pipeline

EchoWave uses a CI/CD pipeline to automatically test, build, package, and deploy services.

The general workflow is:

```mermaid
graph TD

    Develop[Developer]

    Develop -->|git push| GitHub[GitHub]

    GitHub -->|Trigger| CI[CI]

    CI --> Tests[Tests / Lint / Build]

    Tests --> Images[Docker Images]

    Images --> Registry[Container Registry]

    Registry -->|CD| Kubernetes[Kubernetes]
