
// -----------------------------------------------------
//zwykla funkcja
void Swap(job & a, job & b);

//szablon
template <typename T> void Swap(T & a, T& b);

//specjalizacja jawna - inna funkcja dla typu job
template <> void Swap<job>(job &a, job &b);

// konkretyzacja jawna - wymuszenie uzycia int.
template void Swap<int>(int a, int );




// -------------------------------------------------------
