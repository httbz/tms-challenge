# BUGFIX.md

**Data da correção:** 21/05/2026
**Corrigido por:** Bernardo Zandonai da Paz

---

## O que era o bug
O bug ocorria no arquivo  `src/Controllers/EntregaController.php`, na linha ~94-95, onde a função de criação (`store`) de entregas verificava se a transportadora existe no banco de dados, mas não verificava em nenhum lugar se ela estava inativa ou ativa.

Adicionei uma verificação extra, a partir da linha 99 até 102, para checar se a transporadora esta ativa ou não (utilizando o campo `deleted_at`). Caso a transportadora esteja inativa, retornará um erro com a mensagem 'Não é possível registrar uma entrega em uma transportadora inativada',  caso contrário, continuará o processo normalmente

---

## Resposta para a Camila (Operações)
Bom dia, Camila! Tudo bem?

Conseguimos identificar o que aconteceu. No momento de cadastrar uma entrega, o sistema não estava verificando se a transportadora já tinha sido desativada. Por isso, mesmo após a inativação da Logística Norte Ltda, ainda era possível realizar novos cadastros vinculados a ela.

A correção já foi aplicada e agora o sistema bloqueia esse tipo de cadastro automaticamente, exibindo uma mensagem informando que a transportadora está inativa.

Também conferimos as entregas anteriores e não encontramos nenhum problema nas que já estavam registradas corretamente antes da desativação.

Sobre as entregas que foram cadastradas depois da inativação, elas continuam no sistema normalmente, então o ideal é apenas revisar esses registros para verificar se alguma delas precisa ser removida ou ajustada.


---

## Como reproduzir (antes da correção)

1. Localizar uma transportadora que esteja inativa no sistema.
2. Tentar cadastrar uma nova entrega vinculada a essa transportadora.
3. Finalizar o cadastro da entrega.
4. Consultar a lista de entregas e verificar que a entrega foi criada normalmente, mesmo utilizando uma transportadora inativa.

## Como verificar que está corrigido

1. Localizar uma transportadora que esteja inativa no sistema.
2. Tentar cadastrar uma nova entrega vinculada a essa transportadora.
3. Ao finalizar o cadastro, verificar que o sistema bloqueia a operação.
4. Confirmar que é exibida uma mensagem informando que não é possível cadastrar entregas para transportadoras inativas.
