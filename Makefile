.PHONY: test

GREEN=\033[32m
RED=\033[31m
RESET=\033[0m

test:
	@echo "環境の確認テストを実行します"
	@vendor/bin/phpunit tests/init/SqlTest.php || { echo "$(RED)SqlTest.php のテストが失敗しました$(RESET)"; exit 1; }
	@vendor/bin/phpstan analyze tests/init/GetUserRepo.php -c test.phpstan.neon --generate-baseline test.neon
	@diff phpstan-baseline.neon test.neon > /dev/null 2>&1 || (echo "$(RED)ファイルに差分があります$(RESET)"; exit 1)
	@rm test.neon
	@curl -s localhost/new.php | grep -q '{"message":"Hello!"}' || { echo "$(RED)レスポンスが不正です$(RESET)"; exit 1; }
	@echo "$(GREEN)\nすべてのテストが成功しました\n$(RESET)"