# neighbors

Project based on Laravel7

## Local setup

- $ ``git clone git@github.com:huenisys/neighbors.git``
- Since Homestead uses SMB for shared dirs, share this project's folder to a pre-created dummy Windows user: <i title="username=vagrant password=vagrant">vagrant</i>. See relevant snippet below.
  ```yaml
  # Homestead.yaml
  ---
  folders:
    - map: '{projectParentPath}\neighbors'
      to: /home/vagrant/code
      smb_username: vagrant
      smb_password: vagrant
  ---
  ```
- Create a Hyper-V virtual switch (Linux-VM-EXT) to be used as bridged network. Note that said hypervisor ignores the IP set in Homestead.yaml but will declare what's used when you launch the machine with ``vagrant up``. Hyper-V is preferred because we all love [Docker](https://www.docker.com/).
  
  Read further here: https://dev.to/nicolus/getting-homestead-to-play-nice-with-hyper-v-4202 on how to make Hyper-V play nicely with Homestead.
- $ ``composer install``
- Copy Homestead.stub.yaml
- $ ``mklink Homestead.yaml Homestead.stub.yaml``, then update sites and it's params for default ENV vars.
- $ ``vagrant up``
- $ ``cd {projectParentPath}/neighbors``
- $ ``mklink .env .env.staging``, then update it accordingly.
- $ ``art key:generate``
- $ ``vagrant ssh``
- $ ``php artisan migrate --seed``
- force SSL, see: https://medium.com/dinssa/ssl-certificates-laravel-homestead-windows-https-f83ec8b3198

### Ignored files

- vagrant on-destroy backups
  - /mysql_backup
  - /postgres_backup
- desktop.ini

### Homestead deployment

- database
  - by default, mysql is used
  - local .env sample uses database: neighbors, user: homestead, password: secret
  - staging .env locally uses database: neighbors_staging
  - dusk stage runs use neighbors_dusk
  - Use SSH tunnel using a capable client like Navicat

#### Testing

- update phpunit.xml
- $ ``vagrant ssh``
- $ ``art config:clear``
- $ ``art test``
- for dusk testing, env: example is used for having a stage deployment locally
- make sure to import homestead crt

## Releasing

- Use ``composer install --no-dev``

## Local stage, env: example

- serves as local staging
- mysql database: neighbors
- APP_ENV: example

## Steps for automated deploy (Staging)

- set env to STAGING
- $ ``cp .env.example .env.staging``
- $ ``art key:generate --env=staging``
- $ ``composer install``
- $ ``touch ~/database.sqlite``
- $ ``art migrate --env=staging``
- $ ``php artisan dusk:install``
- Set APP_URL to match what's used for staging
- Chrome binary should be installed
- $ ``sudo apt update``
- $ ``sudo apt install chromium-browser``
- $ ``php artisan dusk:chrome-driver``


