php artisan migrate --force
mkdir ./storage/app/private/results
mkdir ./storage/app/private
cd ./storage/app/private || :
curl https://raw.githubusercontent.com/FedorViest/opp_prpr2024/refs/heads/main/Tester/install.sh | bash
cd ./tester || :

#php artisan serve
