### Kubernetes with DevSpace
In my kubernetes environment, I relied on DevSpace to simplify everything.

##### Pre-Requisites
- install docker (please checkout the instruction from the [Docker Way](#the-docker-and-laravel-sail-way) Above for instructions)
- install [minikube](#) by following [this instructions](https://minikube.sigs.k8s.io/docs/start/).
- install [DevSpace](https://github.com/loft-sh/devspace)

##### Deploying Local Development Environment

Start minikube

```bash
minikube start
```

Create devspace namespace
```bash
devspace use namespace laravel-restful-api-local
```

Start local environment

```bash
devspace dev
```

#### Services
After the setup, your services should be available at the following URLs.
- Laravel Restful API: [http://localhost/](http://localhost)
- PHPMyAdmin: [http://localhost:8080/](http://localhost:8080)
- MySQL should be at port 3306 (the default port)