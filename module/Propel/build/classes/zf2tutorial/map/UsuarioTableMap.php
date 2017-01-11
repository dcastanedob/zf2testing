<?php



/**
 * This class defines the structure of the 'usuario' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.zf2tutorial.map
 */
class UsuarioTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'zf2tutorial.map.UsuarioTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('usuario');
        $this->setPhpName('Usuario');
        $this->setClassname('Usuario');
        $this->setPackage('zf2tutorial');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idusuario', 'Idusuario', 'INTEGER', true, null, null);
        $this->addColumn('usuario_nombre', 'UsuarioNombre', 'VARCHAR', true, 45, null);
        $this->addColumn('usario_password', 'UsarioPassword', 'VARCHAR', true, 45, null);
        $this->addColumn('usuario_nickname', 'UsuarioNickname', 'VARCHAR', true, 45, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // UsuarioTableMap
