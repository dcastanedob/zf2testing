<?php


/**
 * Base class that represents a row from the 'libro' table.
 *
 *
 *
 * @package    propel.generator.zf2tutorial.om
 */
abstract class BaseLibro extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'LibroPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LibroPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the idlibro field.
     * @var        int
     */
    protected $idlibro;

    /**
     * The value for the libro_nombre field.
     * @var        string
     */
    protected $libro_nombre;

    /**
     * The value for the idautor field.
     * @var        int
     */
    protected $idautor;

    /**
     * The value for the ideditorial field.
     * @var        int
     */
    protected $ideditorial;

    /**
     * @var        Autor
     */
    protected $aAutor;

    /**
     * @var        Editorial
     */
    protected $aEditorial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * Get the [idlibro] column value.
     *
     * @return int
     */
    public function getIdlibro()
    {

        return $this->idlibro;
    }

    /**
     * Get the [libro_nombre] column value.
     *
     * @return string
     */
    public function getLibroNombre()
    {

        return $this->libro_nombre;
    }

    /**
     * Get the [idautor] column value.
     *
     * @return int
     */
    public function getIdautor()
    {

        return $this->idautor;
    }

    /**
     * Get the [ideditorial] column value.
     *
     * @return int
     */
    public function getIdeditorial()
    {

        return $this->ideditorial;
    }

    /**
     * Set the value of [idlibro] column.
     *
     * @param  int $v new value
     * @return Libro The current object (for fluent API support)
     */
    public function setIdlibro($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->idlibro !== $v) {
            $this->idlibro = $v;
            $this->modifiedColumns[] = LibroPeer::IDLIBRO;
        }


        return $this;
    } // setIdlibro()

    /**
     * Set the value of [libro_nombre] column.
     *
     * @param  string $v new value
     * @return Libro The current object (for fluent API support)
     */
    public function setLibroNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->libro_nombre !== $v) {
            $this->libro_nombre = $v;
            $this->modifiedColumns[] = LibroPeer::LIBRO_NOMBRE;
        }


        return $this;
    } // setLibroNombre()

    /**
     * Set the value of [idautor] column.
     *
     * @param  int $v new value
     * @return Libro The current object (for fluent API support)
     */
    public function setIdautor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->idautor !== $v) {
            $this->idautor = $v;
            $this->modifiedColumns[] = LibroPeer::IDAUTOR;
        }

        if ($this->aAutor !== null && $this->aAutor->getIdautor() !== $v) {
            $this->aAutor = null;
        }


        return $this;
    } // setIdautor()

    /**
     * Set the value of [ideditorial] column.
     *
     * @param  int $v new value
     * @return Libro The current object (for fluent API support)
     */
    public function setIdeditorial($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->ideditorial !== $v) {
            $this->ideditorial = $v;
            $this->modifiedColumns[] = LibroPeer::IDEDITORIAL;
        }

        if ($this->aEditorial !== null && $this->aEditorial->getIdeditorial() !== $v) {
            $this->aEditorial = null;
        }


        return $this;
    } // setIdeditorial()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->idlibro = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->libro_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->idautor = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->ideditorial = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 4; // 4 = LibroPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Libro object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aAutor !== null && $this->idautor !== $this->aAutor->getIdautor()) {
            $this->aAutor = null;
        }
        if ($this->aEditorial !== null && $this->ideditorial !== $this->aEditorial->getIdeditorial()) {
            $this->aEditorial = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LibroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LibroPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAutor = null;
            $this->aEditorial = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LibroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LibroQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(LibroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                LibroPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aAutor !== null) {
                if ($this->aAutor->isModified() || $this->aAutor->isNew()) {
                    $affectedRows += $this->aAutor->save($con);
                }
                $this->setAutor($this->aAutor);
            }

            if ($this->aEditorial !== null) {
                if ($this->aEditorial->isModified() || $this->aEditorial->isNew()) {
                    $affectedRows += $this->aEditorial->save($con);
                }
                $this->setEditorial($this->aEditorial);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = LibroPeer::IDLIBRO;
        if (null !== $this->idlibro) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LibroPeer::IDLIBRO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LibroPeer::IDLIBRO)) {
            $modifiedColumns[':p' . $index++]  = '`idlibro`';
        }
        if ($this->isColumnModified(LibroPeer::LIBRO_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = '`libro_nombre`';
        }
        if ($this->isColumnModified(LibroPeer::IDAUTOR)) {
            $modifiedColumns[':p' . $index++]  = '`idautor`';
        }
        if ($this->isColumnModified(LibroPeer::IDEDITORIAL)) {
            $modifiedColumns[':p' . $index++]  = '`ideditorial`';
        }

        $sql = sprintf(
            'INSERT INTO `libro` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`idlibro`':
                        $stmt->bindValue($identifier, $this->idlibro, PDO::PARAM_INT);
                        break;
                    case '`libro_nombre`':
                        $stmt->bindValue($identifier, $this->libro_nombre, PDO::PARAM_STR);
                        break;
                    case '`idautor`':
                        $stmt->bindValue($identifier, $this->idautor, PDO::PARAM_INT);
                        break;
                    case '`ideditorial`':
                        $stmt->bindValue($identifier, $this->ideditorial, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setIdlibro($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aAutor !== null) {
                if (!$this->aAutor->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAutor->getValidationFailures());
                }
            }

            if ($this->aEditorial !== null) {
                if (!$this->aEditorial->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aEditorial->getValidationFailures());
                }
            }


            if (($retval = LibroPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = LibroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdlibro();
                break;
            case 1:
                return $this->getLibroNombre();
                break;
            case 2:
                return $this->getIdautor();
                break;
            case 3:
                return $this->getIdeditorial();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Libro'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Libro'][$this->getPrimaryKey()] = true;
        $keys = LibroPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdlibro(),
            $keys[1] => $this->getLibroNombre(),
            $keys[2] => $this->getIdautor(),
            $keys[3] => $this->getIdeditorial(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aAutor) {
                $result['Autor'] = $this->aAutor->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aEditorial) {
                $result['Editorial'] = $this->aEditorial->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = LibroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdlibro($value);
                break;
            case 1:
                $this->setLibroNombre($value);
                break;
            case 2:
                $this->setIdautor($value);
                break;
            case 3:
                $this->setIdeditorial($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = LibroPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdlibro($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setLibroNombre($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setIdautor($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setIdeditorial($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LibroPeer::DATABASE_NAME);

        if ($this->isColumnModified(LibroPeer::IDLIBRO)) $criteria->add(LibroPeer::IDLIBRO, $this->idlibro);
        if ($this->isColumnModified(LibroPeer::LIBRO_NOMBRE)) $criteria->add(LibroPeer::LIBRO_NOMBRE, $this->libro_nombre);
        if ($this->isColumnModified(LibroPeer::IDAUTOR)) $criteria->add(LibroPeer::IDAUTOR, $this->idautor);
        if ($this->isColumnModified(LibroPeer::IDEDITORIAL)) $criteria->add(LibroPeer::IDEDITORIAL, $this->ideditorial);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(LibroPeer::DATABASE_NAME);
        $criteria->add(LibroPeer::IDLIBRO, $this->idlibro);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdlibro();
    }

    /**
     * Generic method to set the primary key (idlibro column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdlibro($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdlibro();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Libro (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setLibroNombre($this->getLibroNombre());
        $copyObj->setIdautor($this->getIdautor());
        $copyObj->setIdeditorial($this->getIdeditorial());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdlibro(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Libro Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return LibroPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LibroPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Autor object.
     *
     * @param                  Autor $v
     * @return Libro The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAutor(Autor $v = null)
    {
        if ($v === null) {
            $this->setIdautor(NULL);
        } else {
            $this->setIdautor($v->getIdautor());
        }

        $this->aAutor = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Autor object, it will not be re-added.
        if ($v !== null) {
            $v->addLibro($this);
        }


        return $this;
    }


    /**
     * Get the associated Autor object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Autor The associated Autor object.
     * @throws PropelException
     */
    public function getAutor(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aAutor === null && ($this->idautor !== null) && $doQuery) {
            $this->aAutor = AutorQuery::create()->findPk($this->idautor, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAutor->addLibros($this);
             */
        }

        return $this->aAutor;
    }

    /**
     * Declares an association between this object and a Editorial object.
     *
     * @param                  Editorial $v
     * @return Libro The current object (for fluent API support)
     * @throws PropelException
     */
    public function setEditorial(Editorial $v = null)
    {
        if ($v === null) {
            $this->setIdeditorial(NULL);
        } else {
            $this->setIdeditorial($v->getIdeditorial());
        }

        $this->aEditorial = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Editorial object, it will not be re-added.
        if ($v !== null) {
            $v->addLibro($this);
        }


        return $this;
    }


    /**
     * Get the associated Editorial object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Editorial The associated Editorial object.
     * @throws PropelException
     */
    public function getEditorial(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aEditorial === null && ($this->ideditorial !== null) && $doQuery) {
            $this->aEditorial = EditorialQuery::create()->findPk($this->ideditorial, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aEditorial->addLibros($this);
             */
        }

        return $this->aEditorial;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->idlibro = null;
        $this->libro_nombre = null;
        $this->idautor = null;
        $this->ideditorial = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->aAutor instanceof Persistent) {
              $this->aAutor->clearAllReferences($deep);
            }
            if ($this->aEditorial instanceof Persistent) {
              $this->aEditorial->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aAutor = null;
        $this->aEditorial = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LibroPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
