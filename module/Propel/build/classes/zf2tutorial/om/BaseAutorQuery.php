<?php


/**
 * Base class that represents a query for the 'autor' table.
 *
 *
 *
 * @method AutorQuery orderByIdautor($order = Criteria::ASC) Order by the idautor column
 * @method AutorQuery orderByAutorNombre($order = Criteria::ASC) Order by the autor_nombre column
 * @method AutorQuery orderByAutorPais($order = Criteria::ASC) Order by the autor_pais column
 *
 * @method AutorQuery groupByIdautor() Group by the idautor column
 * @method AutorQuery groupByAutorNombre() Group by the autor_nombre column
 * @method AutorQuery groupByAutorPais() Group by the autor_pais column
 *
 * @method AutorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method AutorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method AutorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method AutorQuery leftJoinLibro($relationAlias = null) Adds a LEFT JOIN clause to the query using the Libro relation
 * @method AutorQuery rightJoinLibro($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Libro relation
 * @method AutorQuery innerJoinLibro($relationAlias = null) Adds a INNER JOIN clause to the query using the Libro relation
 *
 * @method Autor findOne(PropelPDO $con = null) Return the first Autor matching the query
 * @method Autor findOneOrCreate(PropelPDO $con = null) Return the first Autor matching the query, or a new Autor object populated from the query conditions when no match is found
 *
 * @method Autor findOneByAutorNombre(string $autor_nombre) Return the first Autor filtered by the autor_nombre column
 * @method Autor findOneByAutorPais(string $autor_pais) Return the first Autor filtered by the autor_pais column
 *
 * @method array findByIdautor(int $idautor) Return Autor objects filtered by the idautor column
 * @method array findByAutorNombre(string $autor_nombre) Return Autor objects filtered by the autor_nombre column
 * @method array findByAutorPais(string $autor_pais) Return Autor objects filtered by the autor_pais column
 *
 * @package    propel.generator.zf2tutorial.om
 */
abstract class BaseAutorQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseAutorQuery object.
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
            $modelName = 'Autor';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new AutorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   AutorQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return AutorQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof AutorQuery) {
            return $criteria;
        }
        $query = new AutorQuery(null, null, $modelAlias);

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
     * @return   Autor|Autor[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AutorPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(AutorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Autor A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdautor($key, $con = null)
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
     * @return                 Autor A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `idautor`, `autor_nombre`, `autor_pais` FROM `autor` WHERE `idautor` = :p0';
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
            $obj = new Autor();
            $obj->hydrate($row);
            AutorPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Autor|Autor[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Autor[]|mixed the list of results, formatted by the current formatter
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
     * @return AutorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AutorPeer::IDAUTOR, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AutorPeer::IDAUTOR, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idautor column
     *
     * Example usage:
     * <code>
     * $query->filterByIdautor(1234); // WHERE idautor = 1234
     * $query->filterByIdautor(array(12, 34)); // WHERE idautor IN (12, 34)
     * $query->filterByIdautor(array('min' => 12)); // WHERE idautor >= 12
     * $query->filterByIdautor(array('max' => 12)); // WHERE idautor <= 12
     * </code>
     *
     * @param     mixed $idautor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function filterByIdautor($idautor = null, $comparison = null)
    {
        if (is_array($idautor)) {
            $useMinMax = false;
            if (isset($idautor['min'])) {
                $this->addUsingAlias(AutorPeer::IDAUTOR, $idautor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idautor['max'])) {
                $this->addUsingAlias(AutorPeer::IDAUTOR, $idautor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AutorPeer::IDAUTOR, $idautor, $comparison);
    }

    /**
     * Filter the query on the autor_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByAutorNombre('fooValue');   // WHERE autor_nombre = 'fooValue'
     * $query->filterByAutorNombre('%fooValue%'); // WHERE autor_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $autorNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function filterByAutorNombre($autorNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($autorNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $autorNombre)) {
                $autorNombre = str_replace('*', '%', $autorNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AutorPeer::AUTOR_NOMBRE, $autorNombre, $comparison);
    }

    /**
     * Filter the query on the autor_pais column
     *
     * Example usage:
     * <code>
     * $query->filterByAutorPais('fooValue');   // WHERE autor_pais = 'fooValue'
     * $query->filterByAutorPais('%fooValue%'); // WHERE autor_pais LIKE '%fooValue%'
     * </code>
     *
     * @param     string $autorPais The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function filterByAutorPais($autorPais = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($autorPais)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $autorPais)) {
                $autorPais = str_replace('*', '%', $autorPais);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AutorPeer::AUTOR_PAIS, $autorPais, $comparison);
    }

    /**
     * Filter the query by a related Libro object
     *
     * @param   Libro|PropelObjectCollection $libro  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 AutorQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLibro($libro, $comparison = null)
    {
        if ($libro instanceof Libro) {
            return $this
                ->addUsingAlias(AutorPeer::IDAUTOR, $libro->getIdautor(), $comparison);
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
     * @return AutorQuery The current query, for fluid interface
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
     * @param   Autor $autor Object to remove from the list of results
     *
     * @return AutorQuery The current query, for fluid interface
     */
    public function prune($autor = null)
    {
        if ($autor) {
            $this->addUsingAlias(AutorPeer::IDAUTOR, $autor->getIdautor(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
