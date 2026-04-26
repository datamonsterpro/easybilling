# EasyBilling PHP API Client

## Requirements

- PHP >= 7.4
- ext-json
- ext-curl

## Installation

```bash
composer require datamonsterpro/easybilling
```

## Пример команды на Yii2 для переноса клиентов в easybilling

```php
<?php

namespace app\commands;

use app\components\ArrayHelper;
use app\components\Logger;
use app\models\User;
use easyBilling\EasyBillingClient;
use easyBilling\models\Transaction;
use yii\console\Controller;

class EasyBillingController extends Controller
{

    public function actionMigrate()
    {
        //выгружаем пользователей
        $users = User::find()
            ->where(['id' => 7])
            ->all();

        //маппинг старый и новых тарифов: id текущего тарифа => id тарифа из easybilling
        $rateMap = [
            1 => 167307
        ];

        //создаем клиента
        $api = new EasyBillingClient('11a77d53-9344-4e4d-b4cd-af32b3507fda');

        //id продукта из easybilling на который будем подписывать
        $productId = 126156;

        foreach ($users as $user) {
            Logger::trace($user->email);

            //создаем клиента
            $res = $api->customer->create($user->email, $user->phone, $user->customer_id, $user->customer_id, $user->created_at);
            if ($api->customer->getLastHttpCode() === 200) {
                Logger::success(' - account ok');
                $customerId = ArrayHelper::getValue($res, 'data.id');
                $rateId = $rateMap[$user->rate_id];

                //создаем подписку, нужно передать $skipTransactionRemainingDays=1 чтобы по подписке не списались средства за текущий месяц и не было двойного списания у клиента.
                $api->subscription->create($customerId, $productId, null, $rateId, 1);
                if ($api->subscription->getLastHttpCode() === 200) {
                    Logger::success(' - subscription ok');
                    $amount = $user->balance;
                    $comment = 'Перенос средств на новый биллинг';
                    
                    //создаем транзакцию на зачисление текущего баланса
                    $api->transaction->create($customerId, Transaction::ACTION_ID_INCOME, Transaction::TYPE_ID_CORRECTION, Transaction::PAYMENT_TYPE_ID_SYSTEM, $amount, null, null, null, $comment);
                    if ($api->transaction->getLastHttpCode() === 200) {
                        Logger::success(' - transaction ok');
                    }
                }
            }
        }
    }
}
```

## License

MIT — see [LICENSE](LICENSE) for details.
