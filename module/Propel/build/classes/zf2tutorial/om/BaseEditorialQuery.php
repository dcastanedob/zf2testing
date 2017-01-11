<?php


/**
 * Base class that represents a query for the 'editorial' table.
 *
 *
 *
 * @method EditorialQuery orderByIdeditorial($order = Criteria::ASC) Order by the ideditorial column
 * @method EditorialQuery orderByEditorialNombre($order = Criteria::ASC) Order by the editorial_nombre column
 *
 * @method EditorialQuery groupByIdeditorial() Group by the ideditorial column
 * @method EditorialQuery groupByEditorialNombre() Group by the editorial_nombre column
 *
 * @method EditorialQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EditorialQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EditorialQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EditorialQuery leftJoinLibro($relationAlias = null) Adds a LEFT JOIN clause to the query using the Libro relation
 * @method EditorialQuery rightJoinLibro($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Libro relation
 * @method EditorialQuery innerJoinLibro($relationAlias = null) Adds a INNER JOIN clause to the query using the Libro relation
 *
 * @method Editorial findOne(PropelPDO $con = null) Return the first Editorial matching the query
 * @method Editorial findOneOrCreate(PropelPDO $con = null) Return the first Editorial matching the query, or a new Editorial object populated from the query conditions when no match is found
 *
 * @method Editorial findOneByEditorialNombre(string $editorial_nombre) Return the first Editorial filtered by the editorial_nombre column
 *
 * @method array findByIdeditorial(int $ideditorial) Return Editorial objects filtered by the ideditorial column
 * @method array findByEditorialNombre(string $editorial_nombre) Return Editorial objects filtered by the editorial_nombre column
 *
 * @package    propel.generator.zf2tutorial.om
 */
abstract class BaseEditorialQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEditorialQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'zf2tutorial';
        }
        if (null === $modelName) {
            $modelName = 'Editorial';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EditorialQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   EditorialQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EditorialQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EditorialQuery) {
            return $criteria;
        }
        $query = new EditorialQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Editorial|Editorial[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EditorialPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EditorialPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Editorial A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdeditorial($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Editorial A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ideditorial`, `editorial_nombre` FROM `editorial` WHERE `ideditorial` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Editorial();
            $obj->hydrate($row);
            EditorialPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Editorial|Editorial[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Editorial[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return EditorialQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EditorialPeer::IDEDITORIAL, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EditorialQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EditorialPeer::IDEDITORIAL, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ideditorial column
     *
     * Example usage:
     * <code>
     * $query->filterByIdeditorial(1234); // WHERE ideditorial = 1234
     * $query->filterByIdeditorial(array(12, 34)); // WHERE ideditorial IN (12, 34)
     * $query->filterByIdeditorial(array('min' => 12)); // WHERE ideditorial >= 12
     * $query->filterByIdeditorial(array('max' => 12)); // WHERE ideditorial <= 12
     * </code>
     *
     * @param     mixed $ideditorial The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EditorialQuery The current query, for fluid interface
     */
    public function filterByIdeditorial($ideditorial = null, $comparison = null)
    {
        if (is_array($ideditorial)) {
            $useMinMax = false;
            if (isset($ideditorial['min'])) {
                $this->addUsingAlias(EditorialPeer::IDEDITORIAL, $ideditorial['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ideditorial['max'])) {
                $this->addUsingAlias(EditorialPeer::IDEDITORIAL, $ideditorial['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditorialPeer::IDEDITORIAL, $ideditorial, $comparison);
    }

    /**
     * Filter the query on the editorial_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByEditorialNombre('fooValue');   // WHERE editorial_nombre = 'fooValue'
     * $query->filterByEditorialNombre('%fooValue%'); // WHERE editorial_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $editorialNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EditorialQuery The current query, for fluid interface
     */
    public function filterByEditorialNombre($editorialNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($editorialNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $editorialNombre)) {
                $editorialNombre = str_replace('*', '%', $editorialNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EditorialPeer::EDITORIAL_NOMBRE, $editorialNombre, $comparison);
    }

    /**
     * Filter the query by a related Libro object
     *
     * @param   Libro|PropelObjectCollection $libro  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 EditorialQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLibro($libro, $comparison = null)
    {
        if ($libro instanceof Libro) {
            return $this
                ->addUsingAlias(EditorialPeer::IDEDITORIAL, $libro->getIdeditorial(), $comparison);
        } elseif ($libro instanceof PropelObjectCollection) {
            return $this
                ->useLibroQuery()
                ->filterByPrimaryKeys($libro->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLibro() only accepts arguments of type Libro or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Libro relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EditorialQuery The current query, for fluid interface
     */
    public function joinLibro($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Libro');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Libro');
        }

        return $this;
    }

    /**
     * Use the Libro relation Libro object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   LibroQuery A secondary query class using the current class as primary query
     */
    public function useLibroQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLibro($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Libro', 'LibroQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Editorial $editorial Object to remove from the list of results
     *
     * @return EditorialQuery The current query, for fluid interface
     */
    public function prune($editorial = null)
    {
        if ($editorial) {
            $this->addUsingAlias(EditorialPeer::IDEDITORIAL, $editorial->getIdeditorial(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
