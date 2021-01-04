<?php

declare(strict_types=1);

/*
 * @copyright 2021 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @author 2021 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace OC\DB;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Statement;
use OCP\DB\IPreparedStatement;
use PDO;

class PreparedStatement implements IPreparedStatement {

	/** @var Statement */
	private $statement;

	public function __construct(Statement $statement) {
		$this->statement = $statement;
	}

	public function closeCursor(): bool {
		$this->statement->free();

		return true;
	}

	public function fetch($fetchMode = null) {
		return $this->statement->fetch($fetchMode);
	}

	public function fetchAll($fetchMode = null): array {
		return $this->statement->fetchAll($fetchMode);
	}

	public function fetchColumn() {
		return $this->fetchOne();
	}

	public function fetchOne() {
		return $this->statement->fetchOne();
	}

	public function bindValue($param, $value, $type = ParameterType::STRING): bool {
		return $this->statement->bindValue($param, $value, $type);
	}

	public function bindParam($param, &$variable, $type = ParameterType::STRING, $length = null): bool {
		return $this->statement->bindParam($param, $variable, $type, $length);
	}

	public function execute($params = null): bool {
		return $this->statement->execute($params);
	}

	public function rowCount(): int {
		return $this->statement->rowCount();
	}
}
