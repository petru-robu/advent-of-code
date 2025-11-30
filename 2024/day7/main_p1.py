f = open('in1.txt', 'r')

def generate_binary_strings(bit_count):
    binary_strings = []
    def genbin(n, bs=''):
        if len(bs) == n:
            binary_strings.append(bs)
        else:
            genbin(n, bs + '0')
            genbin(n, bs + '1')

    genbin(bit_count)
    return binary_strings

if __name__ == '__main__':

    s = 0

    for line in f.readlines():
        target, list = line.split(':')
        target = int(target)
        v = [int(x) for x in list.split()]

        

        for option in generate_binary_strings(len(v)-1):
            val = v[0]
            for i in range(0, len(v)-1):
                if option[i] == '0':
                    val += v[i+1]
                else:
                    val *= v[i+1]

            if val == target:
                print(val, "is OK")
                s += val
                break
            
    print(s)
