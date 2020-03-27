# neighbors

Project based on Laravel7

## Local setup

- Project was based on https://github.com/huenisys/laravel7
- $ ``git clone git@github.com:huenisys/neighbors.git``
- Go to the project folder and share it to Windows user: vagrant
- Create a Hyper-V virtual switch (Linux-VM-EXT) to be used as bridged network. Hyper-V ignores the IP set in Homestead.yaml but will declare what's used
- Create a local Windows user: vagrant, with password: vagrant and specify credential in the shared folder. Homestead uses SMB.

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
  
  Read further on https://dev.to/nicolus/getting-homestead-to-play-nice-with-hyper-v-4202
- $ ``vagrant up``
- $ ``cd {projectParentPath}/neighbors``
- $ ``composer install``
- $ ``cp .env.example .env``, then update it accordingly
- $ ``art key:generate``
- $ ``vagrant ssh``
- $ ``php artisan migrate``, in project dir

### Ignored files

- vagrant on-destroy backups
  - /mysql_backup
  - /postgres_backup
- desktop.ini

### Homestead deployment

- database
  - by default, mysql is used
  - local .env sample uses database: neighbors, user: homestead, password: secret
  - Use SSH tunnel using a capable client like Navicat

#### Testing

- update phpunit.xml
- $ ``vagrant ssh``
- $ ``art config:clear``
- $ ``art test``
- for dusk testing, env: example is used for having a stage deployment locally

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


