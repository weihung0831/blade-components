# CLAUDE.md

BLADE-COMPONENTS：Laravel 13 + Tailwind v4 的元件庫展示站。站上有三塊：首頁、元件目錄、頁面模板。每個元件都附 Blade、Vue、React 三份原始碼，給人直接複製走。

一律使用繁體中文回答。程式碼一律禁止加註解。

## 專案地圖

- `app/Support/ComponentCatalog.php`：元件目錄的唯一來源（分類、slug、variants 數）
- `app/Support/TemplateCatalog.php`：模板與各模板螢幕的唯一來源
- `app/Support/BladeSyntaxHighlighter.php`：程式碼區塊的語法上色
- `routes/web.php`：全站路由，closure 直接回傳 view，沒有 controller
- `resources/views/catalog/{分類-slug}/{slug}.blade.php`：元件詳細頁
- `resources/views/components/ui/`：元件本體（Blade 版）
- `resources/views/components/previews/{分類-slug}/`：目錄卡片上的縮圖預覽
- `resources/views/components/templates/`：模板縮圖與各螢幕
- `resources/views/templates/pages/`：模板詳細頁
- `resources/js/components/ui/{分類-slug}/`：元件的 Vue / React 版
- `resources/js/templates/{模板}/`：模板螢幕的 Vue / React 版
- `resources/css/app.css`：全站 theme token 與亮色主題
- `.ai/rules/`：依路徑套用的規則，`index.md` 是路徑對照表
- `BOOST.md`：Laravel Boost 官方指南，由 `php artisan boost:update` 維護，勿手改

<important if="你要跑指令來啟動、建置、測試或格式化">

| 指令 | 用途 |
|---|---|
| `composer setup` | 全新環境初始化（安裝、產 key、migrate、build） |
| `composer dev` | 起開發環境（`php artisan dev`，含 Vite） |
| `composer test` | 清 config 後跑全部測試 |
| `php artisan test --filter=xxx` | 跑單一測試 |
| `vendor/bin/pint` | 格式化 PHP |
| `npm run dev` / `npm run build` | 單獨跑 Vite |
| `php artisan pail` | 追 log |
| `php artisan boost:update` | 重新產生 BOOST.md |
</important>

<important if="你要寫或修改任何 PHP">
先讀 `BOOST.md`。
</important>

<important if="你要新增或修改元件目錄裡的元件">

一個元件要同時存在四個地方，缺一個就會有頁面 404 或測試紅：

1. `ComponentCatalog::categories()` 裡登記 slug、name、variants
2. 詳細頁 `resources/views/catalog/{分類-slug}/{slug}.blade.php`
3. 元件本體 `resources/views/components/ui/{slug}.blade.php`
4. 縮圖預覽 `resources/views/components/previews/{分類-slug}/{slug}.blade.php`

Vue / React 版放 `resources/js/components/ui/{分類-slug}/{StudlyName}.{vue,jsx}`，React 匯出名固定是 `Ui{StudlyName}`；詳細頁用 `<x-install :slug="..." vue react />` 把它們讀進來。分類目錄名是分類名的 kebab-case（`Str::slug`）。

詳細頁的排版跟區塊順序照 `resources/views/catalog/actions/button.blade.php`。
</important>

<important if="你要新增或修改頁面模板">

模板同樣分散在多處：

1. `TemplateCatalog::all()` 登記模板，`TemplateCatalog::screens()` 登記各螢幕
2. 縮圖 `resources/views/components/templates/{slug}.blade.php`
3. 各螢幕 `resources/views/components/templates/{模板}/{螢幕}.blade.php`
4. 詳細頁 `resources/views/templates/pages/{slug}.blade.php`
5. Vue / React 版 `resources/js/templates/{模板}/{StudlyName}.{vue,jsx}`

只登記在 catalog、沒有詳細頁的模板會顯示 Soon，測試有在數這個數字。
</important>

<important if="你在寫 resources/views/components/ 底下的 anonymous component">
不要拿 `$slot` 當 `@foreach` 的迴圈變數，會蓋掉傳進來的插槽內容而且不噴錯。細節看 `.ai/rules/components.md`。
</important>

<important if="你要挑顏色、寫樣式或處理亮暗色主題">
顏色一律走 `resources/css/app.css` 的 `@theme` token（`ink-*`、`cream`、`jade-*`、`zinc-*`、white/black alpha）。亮色主題只是把同一批 token 換值，所以不要在 markup 裡硬寫色碼，也不要另外寫 `dark:` 變體。寫死的顏色一切到亮色就會爛。
</important>

<important if="你要寫或修改測試">
Pest 5。`tests/Feature/ComponentCatalogTest.php` 和 `TemplateCatalogTest.php` 會走訪 catalog 裡的每一筆，新增元件或模板不用另外寫測試，但要確定四個檔案都到位。
</important>

<important if="你要動 UI、視覺或版面設計">
這站本身就是設計展示品，版型不能長得像 AI 預設樣式。
</important>

<important if="你要寫給人看的文字：文件、Markdown、README、artifact、頁面文案">
套用 humanizer skill 的準則，把 AI 文風痕跡清掉。
</important>

<important if="你要 commit 或使用者要你寫 commit message">
未經明確要求不執行 `git commit`：改完把變更留在 working tree，回報 `git status` 即可。

Commit message：單行英文標題，遵循 Conventional Commits（`feat:`、`fix:`、`refactor:`、`chore:`、`docs:`）；不寫 body，結尾必加 trailer `Co-Authored-By: Claude Fable 5 <noreply@anthropic.com>`。
</important>
