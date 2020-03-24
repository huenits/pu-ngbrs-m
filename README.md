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
- $ ``cp .env.example .env`, then update it accordingly
- $ ``art key:generate``
- $ ``vagrant ssh``
- $ ``php artisan migrate``, in project dir

### Windows users

If using homestead per project installation, do the following:
- create a Hyper-V virtual switch (Linux-VM-EXT)
- create a local Windows user: vagrant, with password: vagrant and specify credential in the shared folder. Homestead uses SMB.
- read further on https://dev.to/nicolus/getting-homestead-to-play-nice-with-hyper-v-4202

  ```yaml
  # Homestead.yaml
  ---
  folders:
    - map: '{yourPath}\projects\neighbors'
      to: /home/vagrant/code
      smb_username: vagrant
      smb_password: vagrant
  ---
  ```

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
