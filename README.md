## Initial Setup to Launch the App

1. **Clone the Project**: Start by cloning the project from your friend's GitHub repository to your local machine.

   ```bash
   git clone https://github.com/muhammadpadanta/1st_symphony_laravel.git
   ```

2. **Navigate to the project directory**
   ```bash
   cd 1st_symphony_laravel

3. **Install Composer Dependencies**: Navigate to the newly cloned project directory and install Composer dependencies.

   ```bash
   composer install
   ```

4. **Update Composer Autoload and Dependencies**
   
   ```bash
   composer dump-autoload
   composer update
   ```

5. **Launch The App**
   ```bash
   php artisan serve
   ```
## Handling Errors

If you encounter errors, follow these steps:

1. **Recovery Procedure**:

   ```bash
   php artisan serve
   ```

2. **If you encounter an Error Code 500**:

   - Rename `.env-example` to `.env`.
   - Set `APP_DEBUG=true` in the `.env` file.

3. **Generate New Application Key**:

   ```bash
   php artisan key:generate
   ```

4. **Restart the Server**:

   ```bash
   php artisan serve
   ```
## Contact

If you have any questions, suggestions, or feedback, feel free to reach out to us 
<div align="left">
   

   
  <a href="mailto:mpadanta@gmail.com">
    <img src="https://img.shields.io/badge/Gmail-333333?style=for-the-badge&logo=gmail&logoColor=red" />
  </a>
  <a href="https://discord.com/users/389223384048992266" target="_blank">
    <img src="https://img.shields.io/badge/Discord-7289DA?style=for-the-badge&logo=discord&logoColor=white" />
  </a>
  <a href="https://muhammadpadanta.vercel.app/home" target="_blank">
     <img src="https://img.shields.io/badge/Portfolio-FF5722?style=for-the-badge&logo=todoist&logoColor=white" target="_blank" /> <!-- sqlite, safari, google-chrome are other good icon options -->
  </a>
</div>
