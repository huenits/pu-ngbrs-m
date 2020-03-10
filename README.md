# laravel7

## Local setup

### Windows users

If using homestead per project installation, do the following:
- create a Hyper-V virtual switch (Homestead-External)
- create a local Windows user: vagrant, with password: vagrant and specify credential in the shared folder. Homestead uses SMB.

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
