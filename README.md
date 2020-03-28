# pu-ngbrs-m

Project based on Laravel7

## Local setup

- $ ``git clone ${PROJ_REPO}``
- $ ``composer install``
- $ ``cp .env.staging .env``
  - $ ``php artisan key:generate``
  - Update:
    - APP_DOMAIN
    - APP_ENV
    - DB_DATABASE
    - DB_HOST
- $ ``php artisan migrate --seed``
- $ ``php artisan migrate:refresh --env=staging --seed``

### More steps

1. **Enable Hyper-V**

    - Create a Hyper-V virtual switch (Linux-VM-EXT) to be used as bridged network. Note that said hypervisor ignores the IP set in Homestead.yaml but will declare what's used when you launch the machine with ``vagrant up``. Hyper-V is preferred because we all love [Docker](https://www.docker.com/).
    
      Read more here: https://dev.to/nicolus/getting-homestead-to-play-nice-with-hyper-v-4202 on how to make Hyper-V play nicely with Homestead.

2. **Homestead setup**
    - Homestead is Laravel's pre-built machine for team development allowing you to easily host projects locally
    - $ ``cp Homestead.stub.yaml Homestead.yaml``
    - Update folders > map value to project path.
    - Since Homestead uses SMB for shared dirs, share this project's folder to a pre-created dummy Windows user: <i title="username=vagrant password=vagrant">vagrant</i>. See relevant snippet below and note the credential.

      ```yaml
      # Homestead.yaml
      ---
      folders:
        - map: ${PROJ_DIR}
          to: /home/vagrant/code
          smb_username: vagrant
          smb_password: vagrant
      ---
      ```
    - **Database**
      - By default, MySQL is used
        - user: homestead
        - password: secret
      - Environments
        - **_local_** 
          - db_name: **homestead** 
          - as set in Homestead.yaml > sites > params > **DB_DATABASE**
        - **_staging_** 
          - db_name: **homestead_staging**
          - as set in ``/.env.staging``

3. **Install Vagrant**

    - $ ``vagrant up``, it will ask for Hyper-V switch to use for first-time machine build
    - $ ``vagrant ssh``
    - go to project path, usually **_~/code_**
    - $ ``php artisan migrate --seed``
    - SSL Trust Certificates setup, 
      - see: https://medium.com/dinssa/ssl-certificates-laravel-homestead-windows-https-f83ec8b3198
      - $ ``vagrant ssh``
      - $ ``cp /etc/nginx/ssl/ca.homestead.${APP_DOMAIN}.crt ~/code``
      - Go to [chrome://settings](chrome://settings)
      - Search **Manage certificates**
      - Click **Import** , and finish the wizard
        - Set **Place all certificates in the following store** to  
          **Trusted Root Certification Authorities**

## Testing

- Update phpunit.xml
- $ ``php artisan test``
- For Dusk (browser tests), update the Chrome version by running: 
  - $ ``php artisan dusk:chrome-driver``

## Heroku notes

  - Set these config in your app
    - **APP_KEY**
    - **APP_DOMAIN**
    - **APP_ENV**
    - **DATABASE_URL** (this will override the mysql vars)
      - Copy ClearDB MySQL url to DATABASE_URL
    - Run in heroku console, ``php artisan migrate --seed --env=staging``

## Ignored files

- on-destroy of Vagrant machines, database backups are generated here:
  - /mysql_backup
  - /postgres_backup
- desktop.ini

## Releasing

- Use ``composer install --no-dev``

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
