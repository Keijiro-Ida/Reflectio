import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import api from '../api/axios';

export default function Login() {
  const navigate = useNavigate();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');

  const login = async () => {
    setError('');
    try {
      await api.get('/sanctum/csrf-cookie');
      const res = await api.post('/login', { email, password });
      console.log('ログイン成功:', res.data);
      navigate('/reflections');
    } catch (err) {
      console.error('Login failed', err);
      setError('ログインに失敗しました。メールアドレスまたはパスワードを確認してください。');
    }
  };

  return (
    <div className="min-vh-100 bg-light d-flex justify-content-center align-items-center">
      <div className="card shadow-sm p-4" style={{ width: '100%', maxWidth: '400px' }}>
        <h3 className="mb-4 text-center text-primary">ログイン</h3>

        {error && <div className="alert alert-danger">{error}</div>}

        <div className="mb-3">
          <label className="form-label">メールアドレス</label>
          <input
            type="email"
            className="form-control"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            placeholder="test@example.com"
          />
        </div>

        <div className="mb-4">
          <label className="form-label">パスワード</label>
          <input
            type="password"
            className="form-control"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            placeholder="********"
          />
        </div>

        <button onClick={login} className="btn btn-primary w-100">
          ログイン
        </button>
      </div>
    </div>
  );
}
