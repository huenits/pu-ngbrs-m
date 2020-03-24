# laravel7

## Local setup

- $ ``git clone git@github.com:huenisys/laravel7.git``
- $ ``cd laravel7``
- $ ``composer install``

### Windows users

If using homestead per project installation, do the following:
- create a Hyper-V virtual switch (Linux-VM-EXT)
- create a local Windows user: vagrant, with password: vagrant and specify credential in the shared folder. Homestead uses SMB.
- read further on https://dev.to/nicolus/getting-homestead-to-play-nice-with-hyper-v-4202

  ```bash
  composer require laravel/homestead --dev
  vendor\bin\homestead make
  vagrant up
  ```

  ```yaml
  # Homestead.yaml
  ---
  folders:
    - map: 'G:\projects\laravel7'
      to: /home/vagrant/code
      smb_username: vagrant
      smb_password: vagrant
  ---
  ```

### Ignored files

- vagrant on-destroy backups
  - /mysql_backup
  - /postgres_backup

### Homestead deployment

- database
  - by default, mysql is used
  - local .env sample uses database: laravel7, user: homestead, password: secret
  - Use SSH tunnel using a capable client like Navicat
