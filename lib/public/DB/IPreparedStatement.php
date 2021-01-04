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

namespace OCP\DB;

use Doctrine\DBAL\ParameterType;
use PDO;

/**
 * @since 21.0.0
 */
interface IPreparedStatement {

	/**
	 * @return true
	 *
	 * @since 21.0.0
	 */
	public function closeCursor(): bool;

	/**
	 * @param int|null $fetchMode
	 *
	 * @return mixed
	 *
	 * @since 21.0.0
	 */
	public function fetch($fetchMode = null);

	/**
	 * @param int|null $fetchMode
	 *
	 * @return mixed[]
	 *
	 * @since 21.0.0
	 */
	public function fetchAll($fetchMode = null);

	/**
	 * @return mixed
	 *
	 * @since 21.0.0
	 * @deprecated 21.0.0 use \OCP\DB\IPreparedStatement::fetchOne
	 */
	public function fetchColumn();

	/**
	 * @return mixed
	 *
	 * @since 21.0.0
	 */
	public function fetchOne();

	/**
	 * @param int|string $param
	 * @param mixed $value
	 * @param int $type
	 *
	 * @return bool
	 *
	 * @since 21.0.0
	 */
	public function bindValue($param, $value, $type = ParameterType::STRING): bool;

	/**
	 * @param int|string $param
	 * @param mixed $variable
	 * @param int $type
	 * @param int|null $length
	 *
	 * @return bool
	 *
	 * @since 21.0.0
	 */
	public function bindParam($param, &$variable, $type = ParameterType::STRING, $length = null): bool;

	/**
	 * @param mixed[]|null $params
	 *
	 * @return bool
	 *
	 * @since 21.0.0
	 */
	public function execute($params = null): bool;

	/**
	 * @return int
	 *
	 * @since 21.0.0
	 */
	public function rowCount(): int;
}
