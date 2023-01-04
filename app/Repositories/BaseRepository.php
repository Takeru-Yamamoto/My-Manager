<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Closure;
use stdClass;

use App\Repositories\Results\JsonResult;

abstract class BaseRepository
{
    private Builder $query;
    private Model $model;
    private string $tableName;

    private array $errors;
    private bool $alreadySelect;

    public function __construct()
    {
        $this->initialize();
    }

    abstract protected function model(): Model;
    abstract public function toResult(object $entity): JsonResult;

    final private function initialize(): void
    {
        $this->model = $this->model();
        $this->query = $this->model::query();

        $this->tableName = $this->model->getTable();

        $this->errors = [];
        $this->alreadySelect = false;
    }

    final public function reset(): self
    {
        $this->initialize();
        return $this;
    }

    final public function toResultList(Collection $collection): array|null
    {
        if ($collection->isEmpty()) return null;

        return array_map(
            function ($entity) {
                return $this->toResult($entity);
            },
            $collection->all()
        );
    }

    /* useful */
    final public function findById(int $id): JsonResult|null
    {
        return $this->find("id", $id);
    }

    final public function findRawById(int $id): Model|null
    {
        return $this->findRaw("id", $id);
    }


    /* params */
    final public function query(): Builder
    {
        return $this->query;
    }

    final public function tableName(): string
    {
        return $this->tableName;
    }

    final public function errors(): array
    {
        return $this->errors;
    }

    final public function hasError(): bool
    {
        return !empty($this->errors);
    }

    final public function addError(string $method, string $error): self
    {
        $this->errors[] = ["method" => $method, "error" => $error];
        return $this;
    }

    final public function errorLog(): null
    {
        errorLog("SQL ERROR: " . json_encode($this->errors, JSON_UNESCAPED_UNICODE) . " in " . className($this));
        return null;
    }


    /* getter */
    final public function get(?string $column = null, mixed $value = null): array|null
    {
        if ($this->hasError()) return $this->errorLog();

        return $this->toResultList($this->getRaw($column, $value));
    }

    final public function getRaw(?string $column = null, mixed $value = null): Collection|null
    {
        if (!is_null($column) && !is_null($value)) $this->where($column, $value);

        if ($this->hasError()) return $this->errorLog();

        $result = $this->query->get();

        $this->reset();
        return $result;
    }

    final public function find(?string $column = null, mixed $value = null): JsonResult|null
    {
        if ($this->hasError()) return $this->errorLog();

        $result = $this->findRaw($column, $value);

        if (is_null($result)) return $result;

        return $this->toResult($result);
    }

    final public function findRaw(?string $column = null, mixed $value = null): Model|null
    {
        if (!is_null($column) && !is_null($value)) $this->where($column, $value);

        if ($this->hasError()) return $this->errorLog();

        $result = $this->query->first();
        $this->reset();
        return $result;
    }

    final public function count(?string $column = null, mixed $value = null): int|null
    {
        if (!is_null($column) && !is_null($value)) $this->where($column, $value);

        if ($this->hasError()) return $this->errorLog();

        $result = $this->query->count();
        $this->reset();
        return $result;
    }

    final public function isExist(?string $column = null, mixed $value = null): bool|null
    {
        if (!is_null($column) && !is_null($value)) $this->where($column, $value);

        if ($this->hasError()) return $this->errorLog();

        $result = $this->query->exists();
        $this->reset();
        return $result;
    }

    final public function paginate(int $page, int $limit): stdClass
    {
        $result = new stdClass();

        $copy = $this->query();
        $result->items = $this->forPage($page, $limit)->get();

        $this->query = $copy;
        $result->total = $this->count();
        
        return $result;
    }


    /* select */
    final public function select(array|string $columns): self
    {
        if ($this->alreadySelect) {
            return $this->addError(__METHOD__, "既にSELECT句が存在します。");
        }

        $this->query = $this->query->select($columns);
        $this->alreadySelect = true;
        return $this;
    }

    final public function addSelect(array|string $columns): self
    {
        if (!$this->alreadySelect) {
            return $this->addError(__METHOD__, "SELECT句がありません。");
        }

        $this->query = $this->query->addSelect($columns);
        return $this;
    }


    /* where */
    final public function where(string $column, mixed $value, string $operator = "="): self
    {
        $this->query = $this->query->where($column, $operator, $value);
        return $this;
    }

    final public function whereLike(string $column, mixed $value): self
    {
        return $this->where($column, $value, "like");
    }

    final public function whereGreater(string $column, mixed $value): self
    {
        return $this->where($column, $value, ">");
    }

    final public function whereGreaterEqual(string $column, mixed $value): self
    {
        return $this->where($column, $value, ">=");
    }

    final public function whereLess(string $column, mixed $value): self
    {
        return $this->where($column, $value, "<");
    }

    final public function whereLessEqual(string $column, mixed $value): self
    {
        return $this->where($column, $value, "<=");
    }

    final public function whereClosure(Closure $closure): self
    {
        $this->query = $this->query->where($closure);
        return $this;
    }

    final public function whereNot(string $column, mixed $value): self
    {
        $this->query = $this->query->whereNot($column, $value);
        return $this;
    }

    final public function whereIn(string $column, array $values): self
    {
        $this->query = $this->query->whereIn($column, $values);
        return $this;
    }

    final public function whereNotIn(string $column, array $values): self
    {
        $this->query = $this->query->whereNotIn($column, $values);
        return $this;
    }

    final public function whereBetween(string $column, mixed $start, mixed $end): self
    {
        $this->query = $this->query->whereBetween($column, [$start, $end]);
        return $this;
    }

    final public function whereNotBetween(string $column, mixed $start, mixed $end): self
    {
        $this->query = $this->query->whereNotBetween($column, [$start, $end]);
        return $this;
    }

    final public function whereNull(string $column): self
    {
        $this->query = $this->query->whereNull($column);
        return $this;
    }

    final public function whereNotNull(string $column): self
    {
        $this->query = $this->query->whereNotNull($column);
        return $this;
    }

    final public function whereColumn(string $column1, string $column2, string $operator = "="): self
    {
        $this->query = $this->query->whereColumn($column1, $operator, $column2);
        return $this;
    }

    final public function whereColumnGreater(string $column1, string $column2): self
    {
        return $this->whereColumn($column1, $column2, ">");
    }

    final public function whereColumnGreaterEqual(string $column1, string $column2): self
    {
        return $this->whereColumn($column1, $column2, ">=");
    }

    final public function whereColumnLess(string $column1, string $column2): self
    {
        return $this->whereColumn($column1, $column2, "<");
    }

    final public function whereColumnLessEqual(string $column1, string $column2): self
    {
        return $this->whereColumn($column1, $column2, "<=");
    }

    final public function orWhere(string $column, mixed $value, string $operator = "="): self
    {
        $this->query = $this->query->orWhere($column, $operator, $value);
        return $this;
    }

    final public function orWhereLike(string $column, mixed $value): self
    {
        return $this->orWhere($column, $value, "like");
    }

    final public function orWhereGreater(string $column, mixed $value): self
    {
        return $this->orWhere($column, $value, ">");
    }

    final public function orWhereGreaterEqual(string $column, mixed $value): self
    {
        return $this->orWhere($column, $value, ">=");
    }

    final public function orWhereLess(string $column, mixed $value): self
    {
        return $this->orWhere($column, $value, "<");
    }

    final public function orWhereLessEqual(string $column, mixed $value): self
    {
        return $this->orWhere($column, $value, "<=");
    }

    final public function orWhereClosure(Closure $closure): self
    {
        $this->query = $this->query->orWhere($closure);
        return $this;
    }

    final public function orWhereNot(string $column, mixed $value): self
    {
        $this->query = $this->query->whereNot($column, $value);
        return $this;
    }

    final public function orWhereIn(string $column, array $values): self
    {
        $this->query = $this->query->orWhereIn($column, $values);
        return $this;
    }

    final public function orWhereNotIn(string $column, array $values): self
    {
        $this->query = $this->query->orWhereNotIn($column, $values);
        return $this;
    }

    final public function orWhereBetween(string $column, mixed $start, mixed $end): self
    {
        $this->query = $this->query->orWhereBetween($column, [$start, $end]);
        return $this;
    }

    final public function orWhereNotBetween(string $column, mixed $start, mixed $end): self
    {
        $this->query = $this->query->orWhereNotBetween($column, [$start, $end]);
        return $this;
    }

    final public function orWhereNull(string $column): self
    {
        $this->query = $this->query->orWhereNull($column);
        return $this;
    }

    final public function orWhereNotNull(string $column): self
    {
        $this->query = $this->query->orWhereNotNull($column);
        return $this;
    }

    final public function orWhereColumn(string $column1, string $column2, string $operator = "="): self
    {
        $this->query = $this->query->orWhereColumn($column1, $operator, $column2);
        return $this;
    }

    final public function orWhereColumnGreater(string $column1, string $column2): self
    {
        return $this->orWhereColumn($column1, $column2, ">");
    }

    final public function orWhereColumnGreaterEqual(string $column1, string $column2): self
    {
        return $this->orWhereColumn($column1, $column2, ">=");
    }

    final public function orWhereColumnLess(string $column1, string $column2): self
    {
        return $this->orWhereColumn($column1, $column2, "<");
    }

    final public function orWhereColumnLessEqual(string $column1, string $column2): self
    {
        return $this->orWhereColumn($column1, $column2, "<=");
    }

    final public function whereJsonContains(string $jsonColumn, array $values): self
    {
        $this->query = $this->query->whereJsonContains($jsonColumn, $values);
        return $this;
    }

    final public function whereJsonLength(string $jsonColumn, int $length, string $operator = "="): self
    {
        $this->query = $this->query->whereJsonLength($jsonColumn, $operator, $length);
        return $this;
    }

    final public function whereJsonLengthGreater(string $jsonColumn, int $length): self
    {
        return $this->whereJsonLength($jsonColumn, $length, ">");
    }

    final public function whereJsonLengthGreaterEqual(string $jsonColumn, int $length): self
    {
        return $this->whereJsonLength($jsonColumn, $length, ">=");
    }

    final public function whereJsonLengthLess(string $jsonColumn, int $length): self
    {
        return $this->whereJsonLength($jsonColumn, $length, "<");
    }

    final public function whereJsonLengthLessEqual(string $jsonColumn, int $length): self
    {
        return $this->whereJsonLength($jsonColumn, $length, "<=");
    }

    final public function whereDate(string $dateColumn, ?string $date, string $operator = "="): self
    {
        $date = dateUtil($date)->toDateString();
        $this->query = $this->query->whereDate($dateColumn, $operator, $date);
        return $this;
    }

    final public function whereDateGreater(string $dateColumn, ?string $date): self
    {
        return $this->whereDate($dateColumn, $date, ">");
    }

    final public function whereDateGreaterEqual(string $dateColumn, ?string $date): self
    {
        return $this->whereDate($dateColumn, $date, ">=");
    }

    final public function whereDateLess(string $dateColumn, ?string $date): self
    {
        return $this->whereDate($dateColumn, $date, "<");
    }

    final public function whereDateLessEqual(string $dateColumn, ?string $date): self
    {
        return $this->whereDate($dateColumn, $date, "<=");
    }

    final public function whereYear(string $dateColumn, ?int $year, string $operator = "="): self
    {
        if (is_null($year)) {
            $year = dateUtil()->year();
        }

        $this->query = $this->query->whereYear($dateColumn, $operator, $year);
        return $this;
    }

    final public function whereYearGreater(string $dateColumn, ?int $year): self
    {
        return $this->whereYear($dateColumn, $year, ">");
    }

    final public function whereYearGreaterEqual(string $dateColumn, ?int $year): self
    {
        return $this->whereYear($dateColumn, $year, ">=");
    }

    final public function whereYearLess(string $dateColumn, ?int $year): self
    {
        return $this->whereYear($dateColumn, $year, "<");
    }

    final public function whereYearLessEqual(string $dateColumn, ?int $year): self
    {
        return $this->whereYear($dateColumn, $year, "<=");
    }

    final public function whereMonth(string $dateColumn, ?int $month, string $operator = "="): self
    {
        if (is_null($month)) {
            $month = dateUtil()->month();
        }

        if ($month < 1 || $month > 12) {
            return $this->addError(__METHOD__, "monthが有効ではありません。");
        }

        $this->query = $this->query->whereMonth($dateColumn, $operator, $month);
        return $this;
    }

    final public function whereMonthGreater(string $dateColumn, ?int $month): self
    {
        return $this->whereMonth($dateColumn, $month, ">");
    }

    final public function whereMonthGreaterEqual(string $dateColumn, ?int $month): self
    {
        return $this->whereMonth($dateColumn, $month, ">=");
    }

    final public function whereMonthLess(string $dateColumn, ?int $month): self
    {
        return $this->whereMonth($dateColumn, $month, "<");
    }

    final public function whereMonthLessEqual(string $dateColumn, ?int $month): self
    {
        return $this->whereMonth($dateColumn, $month, "<=");
    }

    final public function whereDay(string $dateColumn, ?int $day, string $operator = "="): self
    {
        if (is_null($day)) {
            $day = dateUtil()->day();
        }

        $this->query = $this->query->whereDay($dateColumn, $operator, $day);
        return $this;
    }

    final public function whereDayGreater(string $dateColumn, ?int $day): self
    {
        return $this->whereDay($dateColumn, $day, ">");
    }

    final public function whereDayGreaterEqual(string $dateColumn, ?int $day): self
    {
        return $this->whereDay($dateColumn, $day, ">=");
    }

    final public function whereDayLess(string $dateColumn, ?int $day): self
    {
        return $this->whereDay($dateColumn, $day, "<");
    }

    final public function whereDayLessEqual(string $dateColumn, ?int $day): self
    {
        return $this->whereDay($dateColumn, $day, "<=");
    }

    final public function whereTime(string $dateColumn, ?string $time, string $operator = "="): self
    {
        $time = dateUtil($time)->toTimeString();
        $this->query = $this->query->whereTime($dateColumn, $operator, $time);
        return $this;
    }

    final public function whereTimeGreater(string $dateColumn, ?string $time): self
    {
        return $this->whereTime($dateColumn, $time, ">");
    }

    final public function whereTimeGreaterEqual(string $dateColumn, ?string $time): self
    {
        return $this->whereTime($dateColumn, $time, ">=");
    }

    final public function whereTimeLess(string $dateColumn, ?string $time): self
    {
        return $this->whereTime($dateColumn, $time, "<");
    }

    final public function whereTimeLessEqual(string $dateColumn, ?string $time): self
    {
        return $this->whereTime($dateColumn, $time, "<=");
    }


    /* order by */
    final public function orderBy(string $column, string $order): self
    {
        $this->query = $this->query->orderBy($column, $order);
        return $this;
    }

    final public function asc(string $column = "created_at"): self
    {
        return $this->orderBy($column, "asc");
    }

    final public function desc(string $column = "created_at"): self
    {
        return $this->orderBy($column, "desc");
    }


    /* grouping */
    final public function groupBy(string|array $columns): self
    {
        $this->query = $this->query->groupBy($columns);
        return $this;
    }

    final public function having(string $column, string|int|float|null $value, string $operator = "="): self
    {
        $this->query = $this->query->having($column, $operator, $value);
        return $this;
    }

    final public function havingGreater(string $column, string|int|float|null $value): self
    {
        return $this->having($column, $value, ">");
    }

    final public function havingGreaterEqual(string $column, string|int|float|null $value): self
    {
        return $this->having($column, $value, ">=");
    }
    final public function havingLess(string $column, string|int|float|null $value): self
    {
        return $this->having($column, $value, "<");
    }
    final public function havingLessEqual(string $column, string|int|float|null $value): self
    {
        return $this->having($column, $value, "<=");
    }

    final public function havingBetween(string $column, mixed $start, mixed $end): self
    {
        $this->query = $this->query->havingBetween($column, [$start, $end]);
        return $this;
    }


    /* limit offset */
    final public function limit(int $limit): self
    {
        $this->query = $this->query->limit($limit);
        return $this;
    }

    final public function offset(int $offset): self
    {
        $this->query = $this->query->offset($offset);
        return $this;
    }

    final public function forPage(int $page, int $limit): self
    {
        return $this->limit($limit)->offset(pageOffset($page, $limit));
    }


    /* raw sql */
    final public function selectRaw(string $sql, array $bindings = []): self
    {
        if ($this->alreadySelect) {
            return $this->addError(__METHOD__, "既にSELECT句が存在します。");
        }

        $this->query = $this->query->selectRaw($sql, $bindings);
        $this->alreadySelect = true;
        return $this;
    }

    final public function whereRaw(string $sql, array $bindings = []): self
    {
        $this->query = $this->query->whereRaw($sql, $bindings);
        return $this;
    }

    final public function orWhereRaw(string $sql, array $bindings = []): self
    {
        $this->query = $this->query->orWhereRaw($sql, $bindings);
        return $this;
    }

    final public function havingRaw(string $sql, array $bindings = []): self
    {
        $this->query = $this->query->havingRaw($sql, $bindings);
        return $this;
    }

    final public function orHavingRaw(string $sql, array $bindings = []): self
    {
        $this->query = $this->query->orHavingRaw($sql, $bindings);
        return $this;
    }

    final public function orderByRaw(string $sql, array $bindings = []): self
    {
        $this->query = $this->query->orderByRaw($sql, $bindings);
        return $this;
    }

    final public function groupByRaw(string $sql): self
    {
        $this->query = $this->query->groupByRaw($sql);
        return $this;
    }


    /* join */
    final public function join(string $table, string $tableColumn, string $column, string $operator = "="): self
    {
        $this->query = $this->query->join($table, $this->tableName . "." . $column, $operator, $table . "." . $tableColumn);
        return $this;
    }

    final public function leftJoin(string $table, string $tableColumn, string $column, string $operator = "="): self
    {
        $this->query = $this->query->leftJoin($table, $this->tableName . "." . $column, $operator, $table . "." . $tableColumn);
        return $this;
    }

    final public function rightJoin(string $table, string $tableColumn, string $column, string $operator = "="): self
    {
        $this->query = $this->query->rightJoin($table, $this->tableName . "." . $column, $operator, $table . "." . $tableColumn);
        return $this;
    }
}
