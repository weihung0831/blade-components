# CLAUDE.md

一律使用繁體中文回答。

程式碼一律禁止加註解。

一律以 SaaS 產品的角度看待此專案：思考功能、架構與建議時，考量訂閱方案、多租戶、配額限制、佈建流程等 SaaS 面向。

回答問題與撰寫任何文件（含 artifact、Markdown、README）時，一律套用 humanizer skill 的準則，移除 AI 文風痕跡。

Laravel Boost 官方指南住在 [BOOST.md](BOOST.md)（由 `php artisan boost:update` 自動維護，勿手改）。
寫或修改任何 PHP 前先讀它。

# Git

Commit message 規則：
- 標題只寫單行英文，遵循 Conventional Commits（`feat:`、`fix:`、`refactor:`、`chore:`、`docs:` 等前綴）。
- 不寫敘述性 body，但結尾必須加 trailer：`Co-Authored-By: Claude Fable 5 <noreply@anthropic.com>`。
