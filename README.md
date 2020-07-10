# SmsBundle

`config/packages/creonit_sms.yaml`

```yaml
creonit_sms:
    transport: Creonit\SmsBundle\Transport\SmsTrafficTransport
    transport_config:
      login: 'login'
      password: 'password'
```

`send sms`
```php
use Creonit\SmsBundle\Message\SmsMessage;
use Creonit\SmsBundle\Mime\Phone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SmsController extends AbstractController
{
    public function smsAction()
    {
        $message = new SmsMessage();

        $message
            ->setContent('Message content')
            ->setTo(new Phone('77777777777'))
            ->addTo(new Phone('77777777778'))
            ->addTo('77777777778');

        $this->dispatchMessage($message);
    }
}
```

```php
use Creonit\SmsBundle\Message\SmsMessage;
use Creonit\SmsBundle\Mime\Phone;
use Symfony\Component\Messenger\MessageBusInterface;

class SmsSender
{
    protected $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }
    
    public function send()
    {
        $message = new SmsMessage();

        $message
            ->setContent('Message content')
            ->setTo(new Phone('77777777777'))
            ->addTo(new Phone('77777777778'))
            ->addTo('77777777778');

        $this->messageBus->dispatch($message);
    }
}
```
