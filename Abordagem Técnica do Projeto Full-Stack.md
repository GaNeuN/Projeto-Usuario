# Abordagem Técnica do Projeto Full-Stack

Este projeto full-stack foi desenvolvido para demonstrar a integração de tecnologias modernas e a capacidade de adaptação a novos ambientes. As tecnologias centrais incluem Docker para conteinerização, Hyperf (PHP) para o backend e React com React Query para o frontend.

## Adaptação e Resolução de Desafios

Embora Docker e Hyperf fossem tecnologias novas para mim, a escolha por elas reflete a disposição em aprender e aplicar ferramentas alinhadas às práticas de mercado e, especificamente, às utilizadas nesta empresa. A implementação exigiu a superação de desafios técnicos cruciais:

-   **Orquestração Docker**: A configuração do `docker-compose.yml` foi um ponto de aprendizado significativo, garantindo um ambiente de desenvolvimento consistente e isolado para backend, frontend e banco de dados.

-   **Conectividade em Ambiente Conteinerizado**: Problemas iniciais de conexão do backend com o MySQL foram resolvidos ao identificar a necessidade de utilizar o nome do serviço Docker (`mysql`) em vez de `localhost` para a comunicação interna entre contêineres.

-   **Gestão de CORS**: A comunicação entre o frontend e o backend exigiu a configuração adequada das políticas de Cross-Origin Resource Sharing (CORS) no Hyperf, assegurando a interoperabilidade entre as aplicações.

## Escolhas e Implementações Técnicas

As decisões técnicas foram guiadas pela simplicidade, eficiência e experiência prévia:

-   **Validações no Backend**: As validações de dados para operações de usuário foram implementadas diretamente no PHP (Hyperf), garantindo a integridade dos dados na camada de serviço de forma direta e eficaz.

-   **Gerenciamento de Estado com React Query**: A utilização do React Query no frontend otimizou o gerenciamento de requisições assíncronas, incluindo cache, invalidação e tratamento de estados de carregamento/erro, resultando em uma interface responsiva e código mais limpo para a manipulação de dados.

-   **Feedback ao Usuário**: Alertas visuais foram empregados para fornecer feedback imediato e claro sobre o sucesso ou falha das operações, aprimorando a experiência do usuário.

