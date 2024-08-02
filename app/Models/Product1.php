namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define relationships
    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
}
